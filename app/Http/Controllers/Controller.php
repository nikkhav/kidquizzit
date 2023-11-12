<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function canOrAbort($permission, $defaultCode = 401)
    {
        // Check if there is an authenticated user
        $user = auth()->user();

        // If the user is authenticated and has the necessary permission, allow access
        if ($user && $user->can($permission)) {
            return;
        }

        // If the user is not authenticated, continue without aborting
        if (!$user) {
            return;
        }

        // If the user is authenticated but does not have the necessary permission, abort with the specified status code
        abort($defaultCode);
    }
}
