@extends('layouts.app')

@section('content')
  <div class="text-center container w-50 mx-auto">
        <h1 class="title  my-4"> Sign in</h1>
          <form method="POST" action="{{ route('login') }}">
             @csrf
             <input type="email" name="email" id="email" placeholder="email" class="form-control my-3 @error('email') is-invalid @enderror"value="{{ old('email') }}" required autofocus>                    
                   @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                   @enderror
           <input type="password" name="password" id="password" placeholder="password" class="form-control my-3 @error('password') is-invalid @enderror" required >                   
                   @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <button type="submit" class="btn btn-dark w-100 my-3" name="btn_sign_in">LOGIN</button>
                <p><a href="{{ route('register') }}">Create account</a></p>
         </form>        
  </div>
@endsection
