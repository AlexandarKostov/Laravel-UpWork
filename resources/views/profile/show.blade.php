@extends('layouts.guest')
@section('class', 'background-profile')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    <div class="min-h-screen">
        <p class="font-semibold py-5 mx-3">{{ $user->name }} {{ $user->surname }}'s Profile</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-wrap items-center mx-3">
                <!-- Left Column (Photo and Personal Information) -->
                <div class="w-full lg:w-1/3 mt-3 lg:mt-0 flex items-center">
                    <img src="{{ $user->Avatar() }}" class="w-25 me-5 rounded-full shadow-2xl" alt="...">
                    <div>
                        <span class="text-md font-semibold text-gray-400">Name:</span>
                        <p class="text-xl font-semibold text-black">{{ $user->name }} {{ $user->surname }}</p>
                        <span class="text-md font-semibold text-gray-400">Contact:</span>
                        <a href="/" class="text-link text-black text-md font-semibold">{{ $user->email }}</a>
                    </div>
                </div>
            </div>

            <!-- Right Column (Biography and Skills) -->
            <div class="col-12 col-lg-8 mt-3 mt-lg-0 ps-5">
                <span class="fs-5 fw-semibold text-gray-400">Biography:</span>

                <div class="fs-5 text-gray-400">
                    @if (strlen($user->short_bio) > 120)
                        <span id="short_bio{{ $user->id }}">{{ Str::limit($user->short_bio, 120) }}</span>
                        <span id="long_bio{{ $user->id }}" style="display: none;">{{ $user->short_bio }}</span>
                        <a id="show_more{{ $user->id }}" data-id="{{ $user->id }}" href="#"
                           class="text-orange-500 small text-end">show more</a>
                    @else
                        {{ $user->short_bio }}
                    @endif
                </div>

                <p class="fs-4 text-gray-400 fw-semibold mt-5 mb-0">Skills:</p>
                <div class="row g-0 grid grid-cols-7 gap-4" style="overflow-y: auto;">
                    @foreach ($user->skills as $skill)
                        <div class="col-4 col-sm-2">
                            <label
                                class="form-check-box card-square text-black font-semibold shadow-sm w-100 d-flex flex-column align-items-center justify-content-center bg-light bg-light shadow-sm small border rounded-2 m-1">
                                {{ $skill->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Back Button -->
            <div class="col-12 py-4">
                <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
                   class="mx-6 inline-block px-4 py-2 text-white color-green rounded-md text-sm font-semibold">Back</a>
            </div>
        </div>
        @section('scripts')
            <!-- Add this JavaScript after the view code -->
            <script>
                $('body').on('click', `a[id^='show_more']`, function (e) {
                    e.preventDefault();

                    let id = $(this).attr('data-id');

                    $(`#short_bio${id}`).fadeOut();
                    $(`#long_bio${id}`).fadeIn();
                    $(this).hide(); // Hide the "Show More" link
                });
            </script>
    @endsection
</x-app-layout>
