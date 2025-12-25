<?php

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();



// // fn() は一時的にviewを返すだけの無名関数　先にレイアウトを作って見るためのもの

// Route::get('/recipes', fn() => view('recipes.index'))->name('recipes.index');
// Route::get('/recipes/{id}', fn() => view('recipes.show'));

// Route::middleware('auth')->group(function () {
//     Route::get('/recipes/create', fn() => view('recipes.create'));
//     Route::get('/recipes/{id}/edit', fn() => view('recipes.edit'));

//     Route::get('/mypage', fn() => view('mypage.index'));
//     Route::get('/mypage/edit', fn() => view('mypage.edit'));
// });

Route::get('/',[HomeController::class,'index'])->name('index');

Route::group(['prefix' => 'recipes', 'as' => 'recipes.'], function () {

    Route::get('/', [RecipeController::class,'index'])->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [RecipeController::class,'create'])->name('create');
        Route::post('/store', [RecipeController::class,'store'])->name('store');

        Route::get('/{id}/edit', [RecipeController::class,'edit'])->name('edit');
        Route::patch('/{id}/update', [RecipeController::class,'update'])->name('update');
        Route::delete('/{id}/destroy', [RecipeController::class,'destroy'])->name('destroy');
    });

    // 👇 これを最後にする
    Route::get('/{id}', [RecipeController::class,'show'])->name('show');
});


// my pageの中のページ
Route::middleware('auth')->group(function () {
   route::group(['prefix' =>'mypage','as' => 'mypage.'],function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/show',[UserController::class,'show'])->name('show');
    Route::patch('/update',[UserController::class,'update'])->name('update');
   
    });

});





