<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function canOrAbort($permission, $message = null, $defaultCode = 401)
    {
        if (!auth()->user()->can($permission)) {
            if ($message) {
                abort($defaultCode, $message);
            } else {
                abort($defaultCode);
            }
        }
    }
}
