@extends('layouts.guest')
@section('class', 'background-profile')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <h1 class="font-semibold text-left px-5 overflow-hidden shadow-sm sm:rounded-lg text-xl">New Project !</h1>
    </div>
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="px-2 py-5">
            <div class="flex -mx-2">
                <div class="w-1/2 px-2">
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <div class="relative z-0 w-full mb-1 group">
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Name of project"
                                       autocomplete="name"
                                       class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2
                                            border-gray-300 appearance-none dark:text-black dark:border-gray-600
                                            dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                <label for="name"
                                       class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
                                @error('name')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-1 group">
                                <textarea class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2
                                border-gray-300 appearance-none dark:text-black dark:border-gray-600
                                dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                          placeholder="Description of project" id="description" name="description"
                                          style="height: 220px; resize:none;">{{ old('description') }}</textarea>
                                <label for="description" :value="__('Description')"
                                       class="peer-focus:font-medium absolute text-sm text-black dark:text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black-600 peer-focus:dark:text-black-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
                                @error('description')
                                <div class="text-red small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-2/4 px-2">
                    <h1 class="font-semibold text-left px-5 text-xl">What i need</h1>
                    <div class="inline-flex items-center">
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($academies as $academy)
                                <input type="checkbox" class="form-check-input" name="academy[]"
                                       value="{{ $academy->id }}"
                                       id="academy{{ $academy->id }}">
                                <label for="academy{{ $academy->id }}"
                                       class="form-check-box card-square rounded-lg font-semibold shadow-sm small border rounded-2 m-1">
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
        <div class="px-5">
            <button type="submit"
                    class="text-white color-green font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                CREATE
            </button>
            <a href="{{ route('project.index') }}" class="text-sm font-semibold">Back</a>
        </div>
    </form>
    @section('scripts')
        <script>
            $(function () {
                $('input[type="checkbox"]').on('click', function () {
                    let academySelect = $(this).val();
                    let label = $(`label[for="academy${academySelect}"]`);

                    if ($(this).is(':checked')) {
                        label.addClass('bg-green text-white selected');
                    } else {
                        label.removeClass('bg-green text-white selected');
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
