@extends('layouts.guest')
@section('class', 'background-profile')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <h1 class="font-semibold text-left px-5 overflow-hidden shadow-sm sm:rounded-lg text-xl">My Profile!</h1>
    </div>
    <form method="POST" action="{{ route('profile.update',  ['profile' => Auth::id()]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
        <div class="px-2">
            <div class="flex -mx-2">
                <div class="w-1/2 px-2">
                    <img src="{{ Auth::user()->Avatar() }}" width="80" height="80"
                         class="rounded-full d-block link-dark text-decoration-none" alt="...">
                    <div class="relative z-0 w-full mb-6 group pt-3">
                        <input type="file" name="image" id="image" class="block py-2.5 px-0 w-full" placeholder=" "
                               required/>
                        <label for="image"
                               class="pt-3 peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Click
                            here to change your profile picture
                        </label>
                        @error('image')
                        <div class="text-red small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <div class="relative z-0 w-full mb-1 group">
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required
                                       autofocus autocomplete="email"
                                       class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                <label for="name" :value="__('Name')"
                                       class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                                @error('name')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <div class="relative z-0 w-full mb-1 group">
                                <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}"
                                       required autofocus autocomplete="email"
                                       class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                <label for="surname" :value="__('Surname')"
                                       class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Surname</label>
                                @error('surname')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <div class="relative z-0 w-full mb-1 group">
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required
                                       autofocus autocomplete="email"
                                       class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                <label for="email" :value="__('Email')"
                                       class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                                @error('email')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <div class="relative z-0 w-full mb-1 group">
                                <label for="short_bio" :value="__('Short_bio')"
                                       class="peer-focus:font-medium absolute text-sm text-black-500 dark:text-black-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Biography</label>
                                <textarea rows="8" id="short_bio" type="text" name="short_bio" required
                                          autocomplete="short_bio"
                                          class="block px-0 w-full text-sm text-black-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">{{ Auth::user()->short_bio }}</textarea>
                                @error('short_bio')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-2/4 px-2">
                    <h1 class="font-semibold text-left px-5 text-xl">Skills</h1>
                    <div class="flex flex-wrap gap-3 py-5">
                        <div class="items-center" style="overflow-y: scroll; height: 300px; width: 700px">
                            <div class="grid grid-cols-7">
                                @php
                                    $mySkills = \Illuminate\Support\Facades\Auth::user()->skills()->pluck('skills.id')->toArray();
                                @endphp
                                @foreach ($skills as $skill)
                                    <input type="checkbox" class="form-check-input" name="skill[]"
                                           value="{{ $skill->id }}"
                                           id="skill{{ $skill->id }}" {{ in_array($skill->id, $mySkills) ? 'checked' : '' }}>
                                    <label for="skill{{ $skill->id }}"
                                           class="form-check-box card-square rounded-lg font-semibold {{ in_array($skill->id, $mySkills) ? 'bg-green text-white' : 'bg-gray-200' }} shadow-sm small border rounded-2 m-1">
                                        {{ $skill->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('skill')
                            <div class="text-red small">{{ $message }}</div>
                            @enderror
                        </div>
                        <h1 class="font-semibold text-left px-5 text-xl">Academies</h1>
                        <div class="inline-flex items-center">
                            <div class="grid grid-cols-7 gap-4">
                                @foreach ($academies as $academy)
                                    <input type="radio" class="form-check-input" name="academy"
                                           value="{{ $academy->id }}"
                                           id="academy{{ $academy->id }}" {{ optional(Auth::user())->academy_id == $academy->id ? 'checked' : '' }}>
                                    <label for="academy{{ $academy->id }}" id="academy{{ $academy->id }}"
                                           class="form-check-box card-square rounded-lg font-semibold {{ ($academy->id) ? 'bg-green text-black' : 'bg-white' }} shadow-sm small border rounded-2 m-1">
                                        {{ $academy->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @error('$academy')
                        <div class="text-red small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5">
            <button type="submit"
                    class="text-white color-green font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                EDIT
            </button>
        </div>
    </form>
    @section('scripts')
        <script>
            $(function () {
                $('input[type="checkbox"]').on('click', function () {
                    let skillSelect = $(this).val();
                    let label = $(`label[for="skill${skillSelect}"]`);

                    if ($(this).is(':checked')) {
                        label.addClass('bg-green text-white selected');
                    } else {
                        label.removeClass('bg-green text-white selected');
                    }
                });
                $('input[type="radio"]').on('change', function () {
                    let academySelect = $('input[name="academy"]:checked').val();
                    let labelAcademy = $(`label[for="academy${academySelect}"]`);
                    if ($(this).is(':checked')) {
                        labelAcademy.addClass('bg-green text-white selected');
                        $('label').not(labelAcademy).removeClass('bg-green text-white selected');
                    } else {
                        labelAcademy.removeClass('bg-green text-white selected');
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>

