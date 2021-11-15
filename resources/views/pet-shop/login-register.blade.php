@extends('layouts.master')

@section('title')
    Главная страница регитрации

@endsection

@section('styles')

@endsection

@section('content')

        <div class="breadcrumb-area pt-95 pb-95 bg-img" style="background-image:url(../../../public/img/banner/banner-2.jpg);">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2>Login / Register</h2>
                    <ul>
                        <li><a href="{{route('home')}}">home</a></li>
                        <li class="active">Login / Register</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">

                                            <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <!-- Email Address -->
                                                <div>
                                                    <x-label for="email" :value="__('Email')" />

                                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                                </div>

                                                <!-- Password -->
                                                <div class="mt-4">
                                                    <x-label for="password" :value="__('Password')" />

                                                    <x-input id="password" class="block mt-1 w-full"
                                                             type="password"
                                                             name="password"
                                                             required autocomplete="current-password" />
                                                </div>

                                                <!-- Remember Me -->
                                                <div class="block mt-4">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                                    </label>
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif
                                                    <br/>
                                                        <br/>
                                                        <br/>

                                                        <div class="button-box">

                                                            <x-button class="ml-3">
                                                                {{ __('Log in') }}
                                                            </x-button>
                                                        </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post">
                                                <input type="text" name="user-name" placeholder="Username">
                                                <input type="password" name="user-password" placeholder="Password">
                                                <input name="user-email" placeholder="Email" type="email">
                                                <div class="button-box">
                                                    <button type="submit"><span>Register</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

@endsection

