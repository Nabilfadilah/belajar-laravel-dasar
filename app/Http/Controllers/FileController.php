<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request): string
    {
        $picture = $request->file("picture");

        // agar nama file auto genered jadi random, pake storePubliclyAs
        $picture->storePubliclyAs("picture", $picture->getClientOriginalName(), "public");

        return "Ok : " . $picture->getClientOriginalName();
    }

    // public function upload(Request $request)
    // {
    //     $file = $request->file('picture');
    //     $file->storeAs('pictures', $file->getClientOriginalName());

    //     return "Ok : " . $file->getClientOriginalName();
    // }
}
