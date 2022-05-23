<?php

namespace App\Traits;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Slider;


trait ImageTrait
{
    public function uploadImage($request, $fieldName, $folder)
    {
        if($request->hasFile($fieldName)){
            $files = $request->file($fieldName);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary($folder)->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $data = [
                $fieldName => $imageUrl,
                'public_id' => $publicId
            ];
            return $data;
        }
        return null;
    }

    public function updateImage($request, $fieldName, $folder, $variable)
    {
        if($request->hasFile($fieldName)){
            $files = $request->file($fieldName);
            // Delete old image
            if (isset($variable->public_id)) {
                Cloudinary::destroy($variable->public_id);
            }
            // Upload new image
            $imageUrl = $files->storeOnCloudinary($folder)->getSecurePath();
            // Get public_id
            $publicId = Cloudinary::getPublicId();
            // Get url image and public_id to db
            $data = [
                $fieldName => $imageUrl,
                'public_id' => $publicId
            ];
            return $data;
        }
        return null;
    }

    public function deleteImage($variable)
    {
        //Delete old image
        Cloudinary::destroy($variable->public_id);
    }
}