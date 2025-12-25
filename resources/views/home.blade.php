@extends('layouts.app')

@section('content')
    <div class="hero-wrapper"
     style="background-image: url('{{ asset('images/hero.jpg') }}');">
        <h1>My Recipe</h1>
    </div>

    <div class="container text-center my-5">
        <h1 class="title">NEW RECIPE</h1>
    </div>

    <div class="container my-5">
       <div class="row g-4">
         @foreach($new_recipes as $recipe)
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
         @endforeach
       </div>
        <h3 class="text-center mt-4"><a href="{{ route('recipes.index') }}" class="text-dark text-decoration-none">SEE MORE ></a></h3>
    </div>



    <div class="container my-5 text-center w-50 p-5">
        <h1 class="title mt-5">ABOUT MY RECIPE</h1>

        <p class="mt-4"><b>My Recipe は、毎日の料理をもっと気軽に、もっと楽しく記録できるレシピノートです。</b>
            忙しい日でもサッと書けるように、必要な項目だけをシンプルに設計しました。
            「また作りたい味」を忘れずに残しておける場所。
            あなたの料理の軌跡を、ひとつのレシピブックに。</p>
    </div>

    <section class="features-section bg-light p-5">
        <div class="container text-center my-5 w-75 ">
            <h1 class="title my-3">FEATURES</h1>

            <div class="row my-3 text-start">
                <div class="col-12 col-md-4 ">
                    <h4 class="border-bottom"> <i class="fa-regular fa-pen-to-square"></i> Easy Input</h4>
                    <p>料理名・材料・手順だけ。迷わず登録できる。</p>
                </div>
               
                <div class="col-12 col-md-4">
                    <h4 class="border-bottom"> <i class="fa-solid fa-camera"></i>Visual Recipes</h4>
                    <p>写真を添えるだけで、あなただけの料理アルバムに。</p>
                </div>
                <div class="col-12 col-md-4 ">
                    <h4 class="border-bottom"> <i class="fa-regular fa-user"></i>My page</h4>
                    <p>自分のレシピだけをすぐに呼び出せるマイページ。</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5 text-center w-50 p-3">
        <h4><b>自分だけのレシピブックを作り始めませんか？</b><br>今日作った料理が、未来のあなたの“定番レシピ”になります。</h4>
        <a href="{{ route('register') }}" class="btn btn-dark my-3 p-3">Sign up for free >></a>

    </div>
@endsection
