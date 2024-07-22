@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
              <img
                src="/images/login-placeholder.png"
                alt=""
                class="w-50 mb-4 mb-lg-none"
              />
            </div>
            <div class="col-lg-5">
              <h2>
                Belanja kebutuhan anda, <br />
                menjadi lebih mudah
              </h2>
              <form method="POST" action="{{ route('login') }}" class="mt-3">
                @csrf
                <div class="form-group">
                  <label>Email Address</label>
                  <input id="email" name="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror w-75" 
                    value="{{old('email')}}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                  @enderror
                  <!--<x-input-label for="email" value="__('Email')" />
                  <x-text-input id="email" class="block mt-1 w-75" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                  <x-input-error messages="$errors->get('email')" class="mt-2" />-->
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input id="password" name="password" type="password" class="form-control w-75 @error('password')
                    is-invalid
                  @enderror" required autocomplete="current-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                  @enderror
                  <!--
                  <x-input-label for="password" value="__('Password')" />
                  <x-text-input id="password" class="block mt-1 w-75"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                  <x-input-error messages="$errors->get('password')" class="mt-2" />
                  -->
                </div>
                <button type="submit" class="btn btn-success btn-block w-75 mt-4">Sign In to My Account</button>
                <a href="{{route('register')}}" class="btn btn-signup btn-block w-75 mt-4">
                  Sign Up
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <x-guest-layout style="display: none">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection

