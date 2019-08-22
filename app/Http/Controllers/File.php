<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

trait File
{
    public function upload($request, $entity, $config_path)
    {
        $configs = $this->getConfig($config_path);

        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();

        //filename to store
        $filenametostore = time() . '.' . $extension;

        foreach ($configs as $config) {
            //Upload File
            $request->file('image')->storeAs('public/uploads/' . $config['folder'], $filenametostore);

            //Resize image here
            $thumbnailpath = public_path('storage/uploads/' . $config['folder']. '/' . $filenametostore);

            $img = Image::make($thumbnailpath)->resize($config['width'], $config['height'], function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

        $entity->image = $filenametostore;
        $entity->save();
    }

    public function deleteUploads($entity, $config_path)
    {
        if($entity->image) {
            $configs = $this->getConfig($config_path);

            foreach ($configs as $config) {
                Storage::disk('public')->delete('/uploads/' . $config['folder'] .'/' . $entity->image);
            }
        }
    }

    public function destroyUpload($id)
    {
        $entity = $this->getModel()->findOrFail($id);

        $this->deleteUploads($entity, $this->config_path);
        $entity->image = null;
        $entity->save();

        return redirect()->back()->with('message', trans($this->messages['destroy_image']));
    }

    public function getConfig($config_path)
    {
        $config_path = 'uploads.' . $config_path;

        return collect(config($config_path));
    }
}