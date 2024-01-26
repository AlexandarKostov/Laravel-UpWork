@extends('layouts.guest')
@section('class', 'background-application')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    @foreach($applicants as $applicant)
        @if (!$applicant->is_accepted)
            <form action="/" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="project-icon" style="border: none; background: none;">
                    <img src="{{ asset('/icons/2.png') }}" width="30" height="30" alt="Delete">
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
                        <p class="font-semibold text-sm">{{ $applicant->user->name }} {{ $applicant->user->surname }}</p>
                        <p class="font-semibold text-sm text-orange-500">
                            {{--                                {{ $project->user->academy_id }}--}}
                            /
                        </p>
                        <div class="object-left-bottom pt-10">
                            <p class="font-semibold text-xs">I'm looking for...</p>
                            <div class="flex">
                                @foreach ($applicant->project->profiles as $choose)
                                    <div
                                        class="border-card-options absolute text-xs mx-1 color-green text-white shadow-sm rounded-full p-1 flex-column align-items-center justify-content-center text-center">
                                        {{ $choose->display_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="font-semibold">{{ $applicant->project->name }}</p>
                        @if (strlen($applicant->project->description) > 120)
                            <span
                                id="short_bio{{ $applicant->project->id }}">{{ Str::limit($applicant->project->description, 120) }}</span>
                            <span id="long_bio{{ $applicant->project->id }}"
                                  style="display: none;">{{ $applicant->project->description }}</span>
                            <a id="show_more{{ $applicant->project->id }}" data-id="{{ $applicant->project->id }}"
                               href="#"
                               class="text-orange-500 small text-end">show more</a>
                            <a class="text-orange-500 small text-end" id="show_less{{ $applicant->project->id }}"
                               data-id="{{ $applicant->project->id }}" href="#"
                               style="display: none;">Show Less</a>
                        @else
                            {{ $applicant->project->description }}
                        @endif
                        @if($applicant->is_accepted == "Reviewing")
                            <p class="font-semibold text-xs text-orange-500">Application is in Reviewing Process ...</p>
                        @elseif($applicant->is_accepted == 0)
                            <p class="font-semibold text-xs text-red-500">Application is decliend !</p>
                            <img src="{{ asset('/icons/6.png') }}" width="20" height="20" alt="...">
                        @elseif($applicant->is_accepted == 1)
                            <p class="font-semibold text-xs text-green-500">Application Accepted !</p>
                            <img src="{{ asset('/icons/5.png') }}" width="20" height="20" alt="...">
                        @endif
                        <div
                            class="absolute card-circle color-green text-white text-decoration-none pointer font-semibold">
                            {{ $applicant->project->applications->count() }}<br>Applicants
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
