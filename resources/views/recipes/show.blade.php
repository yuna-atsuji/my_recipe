 @extends('layouts.app') 

@section('content')
<div class="container my-5 w-50 mx-auto">
    <div class="card recipe-card ">
        @if($recipe->image)
            <img src="{{ asset('storage/images/'.$recipe->image) }}" alt="{{ $recipe->image }}" class="card-img-top show-recipe-img">                                
        @else
            <img src="{{ asset('images/no_food_photo.png') }}" alt="no_photo" class="card-img-top recipe-img">
        @endif
        <div class="card-body p-2">
            <h5 class="text-dark m-0">{{ $recipe->title }}</h5>
            <p class="text-muted small mb-2">
                by {{ $recipe->user->name }}
            </p>
                <h6>- Ingredients & Instructions -</h6>
                <p class="text-dark recipe-body">{{ $recipe->body}}</p>
            @isset($recipe->description)
                <h6>- Tips & Notes -</h6>
                <p class="text-dark recipe-body">{{ $recipe->description }}</p>
            @endisset 
            
                
        </div>
        <div class="card-footer">
            <p class="text-muted small mb-0 p-0">
                {{ $recipe->created_at->format('Y/m/d') }}
                </p>
        </div>
    </div>
</div>
@endsection