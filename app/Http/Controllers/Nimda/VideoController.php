<?php

namespace App\Http\Controllers\Nimda;

use App\Http\Controllers\Files;
use App\Video;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class VideoController extends Admin
{
    use Files;

    protected $title = 'Видео';

    protected $config_path = 'video';

    public function getModel()
    {
        return new Video();
    }

    public function getRules($request, $id = false)
    {
        return [
            'title' => 'sometimes|required|max:255',
            'author' => 'sometimes|required|max:255',
            'description' => 'sometimes|required|max:65535',
            'file' => 'file'
        ];
    }

    public function getFormViewName()
    {
        return $this->viewPrefix . 'video.form';
    }

    public function getIndexViewName()
    {
        return $this->viewPrefix . 'video.list';
    }

    public function store(Request $request)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request), [], $this->getAttributes());
        $entity = $this->getModel()->create($request->all());

        if($request->hasFile('file')) {
            $this->upload($request, $entity, $this->config_path);
        }

        if($request->hasFile('image')) {
            $this->uploadPoster($request, $entity, 'video_image');
        }

        $this->after($entity, $request->parent_id);

        return redirect()
            ->route($this->routePrefix . 'edit', ['id' => $entity->id])
            ->with('message', trans($this->messages['store']));
    }

    public function update(Request $request, $id)
    {
        $request->flash();

        $this->validate($request, $this->getRules($request, $id), [], $this->getAttributes());
        $entity = $this->getModel()->findOrFail($id);
        $entity->update($request->all());

        if($request->hasFile('file')) {
            $this->upload($request, $entity, $this->config_path);
        }

        if($request->hasFile('image')) {
            $this->uploadPoster($request, $entity, 'video_image');
        }

        $this->after($entity, $request->parent_id);

        return redirect()->back()->with('message', trans($this->messages['update']));
    }

    public function deletePosterUploads($entity, $config_path)
    {
        if($entity->image) {
            $configs = $this->getPosterConfig($config_path);

            foreach ($configs as $config) {
                Storage::disk('public')->delete('/uploads/' . $config['folder'] .'/' . $entity->image);
            }
        }
    }

    public function destroy($id)
    {
        $entity = $this->getModel()->find($id);
        $entity->delete();

        if($this->config_path) {
            $this->deleteUploads($entity, $this->config_path);
        }

        $this->deletePosterUploads($entity, 'video_image');

        return redirect()->back()->with('message', trans($this->messages['destroy']));
    }

    public function destroyPosterUpload($id)
    {
        $entity = $this->getModel()->findOrFail($id);

        $this->deletePosterUploads($entity, 'video_image');
        $entity->image = null;
        $entity->save();

        return redirect()->back()->with('message', trans($this->messages['destroy_image']));
    }

    protected function setRoutePrefix()
    {
        if (!$this->routePrefix) {
            $this->routePrefix = 'admin_video_';
        }
    }

    protected function uploadPoster($request, $entity, $config_path)
    {
        $configs = $this->getPosterConfig($config_path);

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

    protected function getPosterConfig($config_path)
    {
        $config_path = 'uploads.' . $config_path;

        return collect(config($config_path));
    }
}