<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Storage;

trait StorageImageTrait
{
    public function storageUpload($request, $fieldName, $foderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $name_image = current(explode('.', $fileNameOrigin));
            $fileNameHash = $name_image . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $foderName.'/'.Auth::id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameHash,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;

    }
    public function storageUploadDetail($file, $foderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $name_image = current(explode('.', $fileNameOrigin));
        $fileNameHash = $name_image . rand(0, 99) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $foderName . '/' . Auth::id(), $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];

        return $dataUploadTrait;
    }


}
