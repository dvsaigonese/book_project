<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

trait handleInput
{
    public function storeImage(Request $request)
    {
        $imagePath = '';

        if ($request->hasFile('image_file')) {
            $imageName = time() . '.' . $request->image_file->extension();

            $request->image_file->move(public_path('images'), $imageName);

            $imagePath = 'images/' . $imageName;
        }

        $request->merge(['image' => $imagePath]);

        return $request->all();
    }

    public function updateImage(Request $request, $model)
    {
        $imagePath = $model->image;

        if ($request->hasFile('image_file')) {
            $imageName = time() . '.' . $request->image_file->extension();

            $request->image_file->move(public_path('images'), $imageName);

            $imagePath = 'images/' . $imageName;
        }
        if ($model->image && File::exists(public_path($model->image)) && $request->hasFile('image_file')) {
            File::delete(public_path($model->image));
        }

        $request->merge(['image' => $imagePath]);

        return $request->all();
    }

    public function hashPassword($password)
    {
        return Hash::make($password);
    }
}
