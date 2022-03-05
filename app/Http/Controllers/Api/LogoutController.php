<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\HasApiTokens;

class LogoutController extends Controller
{
    use HasApiTokens;

    public function logout()
    {
       return auth()->user()->tokens()->delete();
    }
}
