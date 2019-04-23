<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file, $address, $filename)
    {
        if (!is_dir(public_path() . '/' . $address))
            File::makeDirectory(public_path() . '/' . $address, 0777, true);
        $path = $file->move($address, $filename);
        return $path;
    }

}
