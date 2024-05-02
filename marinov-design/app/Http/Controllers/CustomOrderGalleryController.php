<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImageKit\ImageKit;

class CustomOrderGalleryController extends Controller
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

    public function upload(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '' . $file->getClientOriginalName();

        $upload = $this->imageKit->upload([
            'file' => fopen($file->getRealPath(), 'r'),
            'fileName' => $fileName,
        ]);


        if ($upload) {
            $imageUrl = $upload->result->url;

            DB::table('custom_order_galleries')->insert([
                'image' => $imageUrl,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Image uploaded successfully', 'url' => $imageUrl], 201);
        } else {
            return response()->json(['message' => 'Failed to upload image'], 500);
        }
    }

    public function test()
    {
        return view('custom_order.test');
    }
}
