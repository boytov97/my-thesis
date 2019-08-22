<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

trait Files
{
    public function upload($request, $entity, $config_path)
    {
        $configs = $this->getConfig($config_path);

        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        //filename to store
        $filenametostore = time() . '.' . $extension;

        foreach ($configs as $config) {
            //Upload File
            $request->file('file')->storeAs('public/uploads/' . $config['folder'], $filenametostore);
        }

        if($config_path === 'video') {
            $this->setDuration($entity, $filenametostore);
        }

        $entity->file = $filenametostore;
        $entity->save();
    }

    public function deleteUploads($entity, $config_path)
    {
        if($entity->file) {
            $configs = $this->getConfig($config_path);

            foreach ($configs as $config) {
                Storage::disk('public')->delete('/uploads/' . $config['folder'] .'/' . $entity->file);
            }
        }
    }

    public function destroyUpload($id)
    {
        $entity = $this->getModel()->findOrFail($id);

        $this->deleteUploads($entity, $this->config_path);
        $entity->file = null;
        $entity->save();

        return redirect()->back()->with('message', trans($this->messages['destroy_file']));
    }

    public function getConfig($config_path)
    {
        $config_path = 'uploads.' . $config_path;

        return collect(config($config_path));
    }

    protected function setDuration($entity, $filenametostore)
    {
        $getID3 = new \getID3;
        $fileFullPath = public_path('storage/uploads/' . $this->getFullFilePath('video') . '/' . $filenametostore);
        $file = $getID3->analyze($fileFullPath);
        $duration = $file['playtime_string'];

        $entity->duration = $duration;
    }

    protected function getFullFilePath($slug)
    {
        return config('uploads.' . $this->config_path . '.' . $slug .'.folder');
    }
}