<?php

namespace App\Services\GalleryManager;

use App\Gallery;

class Uploader
{

    /**
     * {@inheritdoc}
     */
    public static function uploadMultiple64($images, $real_estate_id)
    {
        foreach ($images as $file) {
            $name = $file->getClientOriginalName() . time() . '.' . $file->extension();
            $file->move(public_path() . '/files/', $name);
            $data[] = [
                'filepath' => '/files/' . $name,
                'real_estate_id' => $real_estate_id
            ];
        }

        $saved = Gallery::insert($data);

        if (!$saved) {
            return false;
        }
        return false;
    }

    public static function upload64($img)
    {
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $uniqid = uniqid();
        $file = public_path() . '/files/' . $uniqid . '.' . $image_type;
        file_put_contents($file, $image_base64);

        $gallery = new Gallery();
        $gallery->filepath = '/files/' . $uniqid . '.' . $image_type;

        $saved = $gallery->save();

        if (!$saved) {
            return false;
        }
        return $gallery->id;
    }
}
