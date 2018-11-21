<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\User;

class UploadFiles extends Controller
{
    //
    public function saveFileWithBase64(Request $request) {
        $input = $request->all();

        $base64Image = $input['file'];
        $format = $input['format'];

        $filename =  Str::random(60) .'.'. $format;

        $encoded_image = explode(",", $base64Image)[1];
        $decoded_image = base64_decode($encoded_image);


        try {
            $fileInput = "resources/images/".$filename;
            file_put_contents('' .$fileInput,$decoded_image);

            return response()->json([
                'success'=> [
                    'file_name' => $filename,
                    'path' =>  asset(''.$fileInput)
                ]
            ], 200);
        } catch (\Exception $e) {
           return response()->json(['error'=> 'Error : ' .$e->getMessage()], 400);
        }


        return response()->json(['error'=> 'An error has occurred'], 400);

    }
}
