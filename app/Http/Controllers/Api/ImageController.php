<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public const DISK = 'public';

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(Request $request): array
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($request->has('id')) {
            $user = User::find($request['id']);
            if (Storage::disk(self::DISK)->exists('images/' . $user->image)) {
                Storage::disk(self::DISK)->delete('images/' . $user->image);
            }
        }

        $file = $request->file('image');
        $name = Str::random(10) . '.' . $file->extension();
        Storage::disk(self::DISK)->putFileAs('images', $file, $name);

        return [
            'image_name' =>  $name,
        ];
    }
}
