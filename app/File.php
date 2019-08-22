<?php

namespace App;

trait File
{
    public function getImagePath($field, $slug)
    {
        $image = $this->{$field};

        if($image && is_file(public_path('storage/uploads/' . $this->getFullPath($slug) . '/' . $image))) {
            return asset('storage/uploads/' . $this->getFullPath($slug) . '/' . $image);
        }
    }

    public function getFilePath($field, $slug)
    {
        $file = $this->{$field};

        if($file && is_file(public_path('storage/uploads/' . $this->getFullFilePath($slug) . '/' . $file))) {
            return asset('storage/uploads/' . $this->getFullFilePath($slug) . '/' . $file);
        }
    }

    public function getFullFilePath($slug)
    {
        return config('uploads.' . $this->fileField . '.' . $slug .'.folder');
    }

    public function getFullPath($slug)
    {
        return config('uploads.' . $this->imageField . '.' . $slug .'.folder');
    }
}