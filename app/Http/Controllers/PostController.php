<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function hello($username)
    {
        $username = strtoupper($username);
        return "Hello, $username!";
    }
}
