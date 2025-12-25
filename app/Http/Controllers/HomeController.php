<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{
    //home.blade.phpに３つの新しい投稿だけ表示させる
    public function index()
    {
        $new_recipes = Recipe::latest()->take(3)->get();

        return view('home', compact('new_recipes'));
    }
}
