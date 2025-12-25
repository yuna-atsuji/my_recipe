@extends('layouts.app')

@section('content')
   <div class="container mx-auto text-center mt-5 mb-3">
    <h1 class="title"> EDIT RECIPE <i class="fa-solid fa-pen"></i></h1>
  </div>
  <div class="container w-50 mx-auto mb-5">
    <form action="{{ route('recipes.update',$recipe->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="mb-3">
        <label for="title" class="text-muted form-label">Recipe Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title',$recipe->title) }}" autofocus>
        @error('title')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
     <div class="mb-3">
      <label for="body" class="text-muted form-label">Ingredients & Instructions</label>
      <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old ('body',$recipe->body)}}</textarea>
      @error('body')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="text-muted form-label">Tips & Notes (optional)</label>
      <textarea type="text" name="description" id="description" class="form-control">{{ old('description',$recipe->description) }}</textarea>
      @error('description')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
     <div class="mb-3">
      <label for="image" class="text-muted form-label">Recipe Image (optional)</label>
      <img src="{{ asset('storage/images/'.$recipe->image) }}" alt="{{ $recipe->image }}" class="w-100 img-thumbnail">
      <input type="file"  id="image" name="image" class="form-control" aria-describedby="image-info">
      <p class="text-muted small form-text" id="image-info">
        jpeg, jpg, png, gif / Max 2MB
     </p>
        
        @error('image')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-dark w-100">SAVE</button>
    </form>
  </div>
    
@endsection