<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class RecipeController extends Controller
{
    private $recipe;
    const LOCAL_STORAGE_FOLDER = 'images'; 

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function index(){
        $all_recipe = Recipe::with('user')->latest()->get();
        return view('recipes.index')->with('all_recipe',$all_recipe);
    }

    public function create(){
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:50',
            'body'        => 'required|max:1000',
            'description' => 'nullable|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->recipe->user_id     = Auth::id();
        $this->recipe->title       = $request->title;
        $this->recipe->body        = $request->body;
        $this->recipe->description = $request->description;

        if ($request->hasFile('image')) {
            $this->recipe->image = $this->saveImage($request->file('image'));
        }

        $this->recipe->save();

        return redirect()->route('recipes.index');
    }

    private function saveImage($image){
        $image_name = time().".".$image->extension();

        $image->storeAs(self::LOCAL_STORAGE_FOLDER,$image_name,'public');

        return $image_name;
    }

    public function show($id){
        $recipe = $this -> recipe ->findOrFail($id);
        return view('recipes.show')->with('recipe',$recipe);
    }

    public function edit($id){
        $recipe = $this->recipe->FindOrFail($id);
        
        //念の為のユーザーじゃない人が編集できないようするif
        if($recipe->user->id != Auth::user()->id){
            return redirect()->back();
        }

        return view('recipes.edit')->with('recipe',$recipe);

    }

    public function update(Request $request ,$id){
        $request->validate([
            'title'       => 'required|max:50',
            'body'        => 'required|max:1000',
            'description' => 'nullable|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',            
        ]);

         $recipe              = Recipe::findOrFail($id);

         $recipe->title       = $request->title;
         $recipe->body        = $request->body;
         $recipe->description = $request->description;
         
         if($request->hasFile('image')){

            if($request->image){
                $this->deleteImage($recipe->image);

                $recipe->image = $this->saveImage($request->image);
            }
        }

         $recipe->save();

         return redirect()->route('index');
    }

    private function deleteImage($image){

        $image_path = self::LOCAL_STORAGE_FOLDER.$image;

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
        }
    }

    public function destroy($id){
        $recipe = $this->recipe->findOrFail($id);

        if($recipe->user->id != Auth::user()->id){
            return redirect()->back();
        }

        $this->deleteImage($recipe->image);
        $recipe->delete();

        return redirect()->back();
    }

   


}
