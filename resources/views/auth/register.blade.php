@extends('layouts.app')

@section('content')
  <div class="text-center container w-50 mx-auto">
        <h1 class="title  my-4"> Create your account</h1>

        <p class="my-4 ">Create your account.<br> Start collection and sharing your favorite recipes.</p>

        <form action="" method="post">
            @csrf
           <input type="text" name="name" id="name" placeholder="name" class="form-control my-3">
            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
           @enderror
             
            <input type="email" name="email" id="email" placeholder="email" class="form-control my-3">
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
           @enderror

            <input id="password" type="password" class="form-control my-3 @error('password') is-invalid @enderror" name="password" placeholder="password" required autocomplete="new-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
           @enderror

            <input id="password-confirm" type="password" class="form-control my-3" name="password_confirmation" placeholder="confirm password" required autocomplete="new-password">
           
            <button type="submit" class="btn btn-dark w-100 my-3" name="btn_sign_up">CREATE</button>
            <p class="small">Already have an account?<a href="{{ route('login') }}"> Sign in</a></p>
        </form>
    </div>
@endsection
