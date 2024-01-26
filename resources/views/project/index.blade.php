@extends('layouts.guest')
@section('class', 'background-profile')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    @if(\Illuminate\Support\Facades\Auth::user()->is_edited == 1)
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid-cols-12">
                    <p class="font-semibold mb-0">Have a new idea to make the world better?</p>
                    <a href="{{ route('project.create') }}" class="text-xl font-semibold">Create new project
                        <img src="{{ asset('/icons/1.png') }}" width="30" height="30" alt="..."
                             style="display: inline-block">
                    </a>
                </div>
            </div>
        </div>
        @foreach($projects as $project)
            @if ($project->assembled == 0)
                <a href="{{ route('project.edit', $project->id) }}" class="absolute project-icon">
                    <img src="{{ asset('/icons/8.png') }}" width="30" height="30" alt="...">
                </a>
                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="project-icon" style="border: none; background: none;">
                        <img src="{{ asset('/icons/7.png') }}" width="30" height="30" alt="Delete">
                    </button>
                </form>
            @endif
            <div class="flex justify-center items-center py-5">
                <div class="max-w-4xl mx-auto p-4">
                    <div class="flex justify-between bg-white rounded-lg">
                        <div class="p-8">
                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->Avatar() }}"
                                 class="absolute card-image rounded-full shadow-sm" width="100"
                                 height="100" alt="...">
                            <p class="font-semibold text-sm">{{ $project->user->name }} {{ $project->user->surname }}</p>
                            <p class="font-semibold text-sm text-orange-500">
                                {{--                                {{ $project->user->academy_id }}--}}
                                /
                            </p>
                            <div class="object-left-bottom pt-10">
                                <p class="font-semibold text-xs">I'm looking for...</p>
                                <div class="flex">
                                    @foreach ($project->profiles as $choose)
                                        <div
                                            class="border-card-options absolute text-xs mx-1 color-green text-white shadow-sm rounded-full p-1 flex-column align-items-center justify-content-center text-center">
                                            {{ $choose->display_name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            <p class="font-semibold">{{ $project->name }}</p>
                            @if (strlen($project->description) > 120)
                                <span
                                    id="short_bio{{ $project->id }}">{{ Str::limit($project->description, 120) }}</span>
                                <span id="long_bio{{ $project->id }}"
                                      style="display: none;">{{ $project->description }}</span>
                                <a id="show_more{{ $project->id }}" data-id="{{ $project->id }}" href="#"
                                   class="text-orange-500 small text-end">show more</a>
                                <a class="text-orange-500 small text-end" id="show_less{{ $project->id }}"
                                   data-id="{{ $project->id }}" href="#"
                                   style="display: none;">Show Less</a>
                            @else
                                {{ $project->description }}
                            @endif
                            @if ($project->assembled)
                                <div
                                    class="absolute card-circle color-green text-white text-decoration-none pointer font-semibold">
                                    {{ $project->applications->count() }}<br>Applicants
                                </div>
                            @else
                                <a href="{{  route('application.show', $project->id) }}"
                                   class="absolute card-circle color-green text-white text-decoration-none pointer font-semibold">
                                    {{ $project->applications->count() }}<br>Applicants</a>
                            @endif
                            @if ($project->assembled)
                                <img src="{{ asset('/icons/badge.png') }}" class="" width="40"
                                     height="40"
                                     alt="...">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="font-semibold mb-0">Please edit your profile so you can use our futures</p>
    @endif
    @section('scripts')
        <script>
            $(function () {
                $('a.options').on('click', function (e) {
                    e.preventDefault()
                    this.closest('form').submit()
                });
                $('body').on('click', `a[id^='show_more']`, function (e) {
                    e.preventDefault();

                    let id = $(this).attr('data-id');

                    $(`#short_bio${id}`).fadeOut();
                    $(`#long_bio${id}`).fadeIn();
                    $(`#show_more${id}`).hide();
                    $(`#show_less${id}`).show();
                });

                $('body').on('click', `a[id^='show_less']`, function (e) {
                    e.preventDefault();

                    let id = $(this).attr('data-id');

                    $(`#long_bio${id}`).fadeOut();
                    $(`#short_bio${id}`).fadeIn();
                    $(`#show_less${id}`).hide();
                    $(`#show_more${id}`).show();
                });
            });
        </script>
    @endsection
</x-app-layout>
