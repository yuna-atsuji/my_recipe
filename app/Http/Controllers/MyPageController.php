<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class MyPageController extends Controller{


    public function index(){
        $recipes = Recipe::where('user_id', Auth::id())
                         ->latest()
                         ->get();

        return view('mypage.index',compact('recipes'));
    }
    
}
