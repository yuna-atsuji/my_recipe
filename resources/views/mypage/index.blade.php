
@extends('layouts.app')

@section('content')
  <div class="container my-5 w-75 mx-auto">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="profile-photo">
                    @if (auth()->user()->avatar)
                      <img src="{{ asset('storage/avatars/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->avatar }}" class="profile-img ">  
                    @else
                        <i class="fa-solid fa-user text-secondary  mypage-icon"></i>
                    @endif
                   
                </div>
                <h3>{{ auth()->user()->name }}</h3>
                <h6>{{ auth()->user()->email }}</h6>
            </div>
            <div class="col-12 col-md-8">
                <h5 class="mt-5">Comment</h5>
                <div class="comment">
                        <p class="p-2">{{ auth()->user()->comment }}</p>
                    
                        {{-- <p class="text-secondary"> You can write about you.</p> --}}
               
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfile">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mypage.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="profile-photo text-center mb-3">
                                @if ($user->avatar)
                                  <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="{{ $user->avatar }}" class="profile-img">  
                                @else
                                  <i class="fa-solid fa-user text-secondary  mypage-icon"></i>
                               @endif                               
                            </div>
                            <input type="file" name="avatar" class="form-control mb-2" aria-describedby="avatar-info">
                            <div class="form-text mb-3" id="avatar-info">
                                Acceptable formats are jpeg, jpg, png, gif only,<br>
                                Maximum file size is 2048KB
                            </div>
                            {{-- Error --}}
                            @error('avatar')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="name" class="form-label m-0 p-0">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control mb-2 ">
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="email" class="form-label m-0">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"  class="form-control mb-2">
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <label for="comment" class="form-label m-0">Comment</label>
                            <textarea name="comment" id="comment" class="form-control mb-2">{{ old('comment',auth()->user()->comment) }}</textarea>
                            @error('comment')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                 </form>
                </div>
            </div>
            
        </div>
   


    <div class="container text-center my-5">
        <h1 class="title">MY RECIPE</h1>
    </div>
   <div class="row container mx-auto ">
     @forelse ($recipes as $recipe)
                <div class="col-12 col-md-4 mb-5">
                        <div class="card recipe-card">
                            @if($recipe->image)
                              <img src="{{ asset('storage/images/'.$recipe->image) }}" alt="{{ $recipe->image }}" class="card-img-top recipe-img">                                
                            @else
                              <img src="{{ asset('images/no_food_photo.png') }}" alt="no_photo" class="card-img-top recipe-img">
                            @endif
                            <div class="card-body p-2">
                                <h5 class="text-dark m-0">{{ $recipe->title }}</h5>
                                <p class="text-muted small mb-2">
                                   by {{ $recipe->user->name }}
                                </p>
                                  <h6>- Ingredients & Instructions -</h6>
                                 <p class="text-dark recipe-body">{{ $recipe->body }}</p>
                                @isset($recipe->description)
                                    <h6>- Tips & Notes -</h6>
                                    <p class="text-dark recipe-body">{{ $recipe->description }}</p>
                                @endisset 
                                
                            </div>
                               <div class="card-footer d-flex justify-content-between align-items-center mt-2">
                                 <p class="text-muted small mb-0 p-0">
                                  {{ $recipe->created_at->format('Y/m/d') }}
                                 </p>
                                 <div>
                                  <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-outline-dark btn-sm me-2">
                                   <i class="fa-solid fa-pen"></i>Edit
                                  </a>

                                  <form action="{{ route('recipes.destroy',$recipe->id) }}" method="post" class="d-inline">
                                    @csrf
                                     @method('DELETE')
                                        <button type="submit" class="btn btn-dark btn-sm">
                                            <i class="fa-solid fa-trash-can"></i>Delete
                                        </button>
                                  </form>
                                  </div>
                                 
                              </div>    
                        </div>
                    
                </div>
             @empty
            <div class="text-center " style="margin-top: 100px">
                <h2 class="text-secondary">No Recipe Yet</h2>
                <a href="{{ route('recipes.create') }}" class="text-decoration-none">Create a new post</a>
            </div>
        @endforelse
 </div>

    
@endsection