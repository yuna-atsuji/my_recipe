@extends('layouts.app')

@section('content')
  <div class="container mx-auto text-center mt-5 mb-3">
    <h1 class="title">ADD RECIPE</h1>
  </div>
  <div class="container w-50 mx-auto mb-5">
    <form action="{{ route('recipes.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="text-muted form-label">Recipe Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" autofocus>
        @error('title')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
     <div class="mb-3">
      <label for="body" class="text-muted form-label">Ingredients & Instructions</label>
      <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old ('body')}}</textarea>
      @error('body')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="text-muted form-label">Tips & Notes (optional)</label>
      <textarea type="text" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
      @error('description')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
     <div class="mb-3">
      <label for="image" class="text-muted form-label">Recipe Image (optional)</label>
      <input type="file"  id="image" name="image" class="form-control" aria-describedby="image-info">
      <p class="text-muted small form-text" id="image-info">
        jpeg, jpg, png, gif / Max 2MB
     </p>
        
        @error('image')
         <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-dark w-100">ADD</button>
    </form>
  </div>
    
@endsection