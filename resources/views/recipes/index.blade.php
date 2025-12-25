@extends('layouts.app')

@section('content')

   <div class="row g-4 container mx-auto mb-5 mt-3">
       
           <div class="container text-center mt-5">
             <h1 class="title">ALL RECIPE</h1>
           </div>
               @forelse ($all_recipe as $recipe)
                <div class="col-12 col-md-4 mb-3">
                    <a href="{{ route('recipes.show',$recipe->id) }}" class="text-decoration-none" >
                        <div class="card recipe-card">
                            @if($recipe->image)
                              <img src="{{ asset('storage/images/'.$recipe->image) }}" alt="{{ $recipe->image }}" class="card-img-top recipe-img">                                
                            @else
                              <img src="{{ asset('images/no_food_photo.png') }}" alt="no_photo" class="card-img-top recipe-img">
                            @endif
                            <div class="card-body p-2 recipe-card-body">
                                <h5 class="text-dark m-0">{{ $recipe->title }}</h5>
                                <p class="text-muted small mb-2">
                                   by {{ $recipe->user->name }}
                                </p>
                                  {{-- Str::limit 長文が暴れない --}}
                                <h6>- Ingredients & Instructions -</h6>
                                 <p class="text-dark recipe-body clamp-6">{{ Str::limit($recipe->body, 60) }}</p>
                                @isset($recipe->description)
                                   <h6>- Tips & Notes -</h6>
                                    <p class="text-dark recipe-body clamp-6">{{ $recipe->description }}</p>
                                @endisset                        
                            </div>
                            <div class="card-footer">
                              <p class="text-muted small mb-0 p-0">
                                  {{ $recipe->created_at->format('Y/m/d') }}
                                 </p>
                            </div>
                           
                        </div>
                    </a>
                </div>
            @empty
            <div class="text-center " style="margin-top: 100px">
                <h2 class="text-secondary">No Recipe Yet</h2>
                <a href="{{ route('recipes.create') }}" class="text-decoration-none">Create a new post</a>
            </div>
        @endforelse
 </div>


    
@endsection