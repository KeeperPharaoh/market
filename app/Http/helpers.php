<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('imageBase64Upload')) {
    function imageBase64Upload($image, $path): string
    {
        $type = $image['type'];
        $image  = base64_decode($image['data']);
        $imageName = $path . "-" . time() . "." . $type;
        Storage::disk('public')->put($path . '/' . $imageName, $image);
        return $path . '/' . $imageName;
    }
}
