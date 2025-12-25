<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Recipe;



class UserController extends Controller
{
    private $user;
    const LOCAL_STORAGE_FOLDER = 'avatars/';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = Auth::user();
        //my pageでrecipeを見れるようにする
        $recipes = Recipe::where('user_id', $user->id)
                     ->latest()
                     ->get();
        return view('mypage.index', compact('user','recipes'));
    }


    public function show(){
        return view('mypage.index')->with('user',Auth::user());
    }

    public function update(Request $request){
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'name'   => 'required|max:50',
            'email'  => 'required|email|max:50|unique:users,email,'.Auth::user()->id,
            'comment' => 'nullable|max:1000',
        ]);

        $user = $this->user->FindOrFail(Auth::user()->id);
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->comment = $request->comment;

        if($request->hasFile('avatar')){

            if($user->avatar){
                $this->deleteAvatar($user->avatar);
            }

            $user->avatar = $this->saveAvatar($request->file('avatar'));
        }

        $user->save();
        return redirect()->route('mypage.index');
    }

    private function saveAvatar($avatar){
        $avatar_name =time().".".$avatar->extension();
        $avatar->storeAs('avatars',$avatar_name,'public');

        return $avatar_name;
    }

    private function deleteAvatar($avatar){
        $avatar_path = 'avatars/'.$avatar;

        if(Storage::disk('public')->exists($avatar_path)){
            Storage::disk('public')->delete($avatar_path);
        }
    }


}
