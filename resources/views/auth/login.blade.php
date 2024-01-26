@extends('layouts.guest')
@section('class', 'background-login')
@section('name', 'ALEKSANDAR')
@section('surname', 'PRENEURS')
@section('quotes', 'Propel your ides to life!')
@section('content')
    <div class="flex justify-start lg:w-0 lg:flex-1 sm:mb-0 px-10">
        <a href="/">
            <h1 class="text-5xl font-bold font-mono">
                @yield('name')<span class="font-bold text-gray-500">@yield('surname')</span>
            </h1>
            <h2 class="font-normal text-2xl">@yield('quotes')</h2>
        </a>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 class="text-2xl font-bold font-mono my-5">LOGIN</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <div class="relative z-0 w-full mb-1 group">
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="email" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                    <label for="email" :value="__('Email')" class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
        </div>
        <!-- Password -->
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <div class="relative z-0 w-full mb-1 group">
                    <input type="password" id="password"
                           name="password"
                           required autocomplete="current-password" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                    <label for="password" :value="__('Password')" class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-primary-button class="text-white color-orange hover:bg-orange-50-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-orange-700 focus:outline-none dark:focus:ring-orange-800">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex items-center justify-center">
            <h3>Don't have account yet , register <span class="underline"><a href="{{ route('register') }}"</a>here!</span></h3>
        </div>
    </form>
@endsection


