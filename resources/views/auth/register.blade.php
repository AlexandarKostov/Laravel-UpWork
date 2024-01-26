@extends('layouts.guest')
@section('class', 'background-register')
@section('content')

  <div class="mx-5">
      <form method="POST" action="{{ route('register') }}">
          @csrf
          <h2 class="text-2xl font-bold font-mono my-5">REGISTER</h2>
          <!-- Name -->
          <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                  <div class="relative z-0 w-full mb-1 group">
                      <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                      <label for="name" :value="__('Name')"  class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>
              </div>
          </div>
          <!-- Surname -->
          <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                  <div class="relative z-0 w-full mb-1 group">
                      <input id="surname" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="name" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                      <label for="surname" :value="__('Surname')"  class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Surname</label>
                      <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                  </div>
              </div>
          </div>
          <!-- Email Address -->
          <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                  <div class="relative z-0 w-full mb-1 group">
                      <input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                      <label for="email" :value="__('Email')" class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
              </div>
          </div>
          <!-- Password -->
          <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                  <div class="relative z-0 w-full mb-1 group">
                      <input id="password"  type="password"
                             name="password"
                             required autocomplete="new-password" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                      <label for="password" :value="__('Password')" class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
              </div>
          </div>

          <!-- Biography -->
          <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-6 group">
                  <div class="relative z-0 w-full mb-1 group">
                    <textarea rows="8" id="short_bio"  type="text"
                              name="short_bio"
                              required autocomplete="short_bio" class="block py-2.5 px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer""></textarea>
                      <label for="short_bio" :value="__('Short_bio')" class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Biography</label>
                      <x-input-error :messages="$errors->get('short_bio')" class="mt-2" />
                  </div>
              </div>
          </div>

          <div class="flex items-center justify-end mt-4">
              <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                  {{ __('Already registered?') }}
              </a>

              <x-primary-button class="text-white color-green hover:bg-green-600 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                  {{ __('Register') }}
              </x-primary-button>
          </div>
      </form>
  </div>
@endsection

