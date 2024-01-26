<x-app-layout>
    @vite(['resources/css/style.css'])
    @include('components.not-edited-profile')
    <div class="background-dashboard min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left column -->
            @if(\Illuminate\Support\Facades\Auth::user()->is_edited == 1)
                <div class="p-6 bg-gray shadow-sm sm:rounded-lg">
                    <h2 class="text-gray-900 font-semibold mb-6">In what field can you be amazing!</h2>
                    <div class="filter flex flex-wrap">
                        <div class="col-md-6 w-2/4 px-2 py-2">
                            <button id="allAcademies" data-academy="all"
                                    class="text-black font-semibold shadow-sm w-100 form-check-box card-square active">
                                All
                            </button>
                        </div>
                        @foreach ($academies as $academy)
                            <div class="col-md-6 w-2/4 px-2 py-2">
                                <button id="academy{{ $academy->id }}" data-academy="{{ $academy->id }}"
                                        class="form-check-box card-square text-black font-semibold shadow-sm w-100 filter-button">{{ $academy->name }}</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right column -->
                <div class="p-6 bg-gray shadow-sm sm:rounded-lg">
                    <h2 class="text-gray-900 font-semibold mb-6">Check the latest projects!</h2>
                    <img src="{{ asset('/icons/3.png') }}" alt="" style="width: 30px; height: 30px">
                    @foreach($projects as $project)
                        @php
                            $projectAcademyIds = $project->applications->pluck('user_id')->toArray();
                        @endphp
                        <div class="flex justify-center items-center py-5">
                            <div class="max-w-4xl mx-auto p-4">
                                <div class="project project-item flex justify-between bg-white rounded-lg">
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
                                        <div id="apps_count{{ $project->id }}"
                                             data-count="{{ $project->applications->count() }}"
                                             class="absolute card-circle color-green text-white text-decoration-none pointer font-semibold">{{ $project->applications->count() }}
                                            <br>Applicants
                                        </div>
                                        <div class="flex justify-end items-center">
                                            <form id="applicationForm" action="{{ route('application.store') }}"
                                                  method="POST">
                                                @csrf <!-- Add CSRF token -->
                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                <button type="button"
                                                        class="text-white color-green font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none inBtn">
                                                    I'm in
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @section('scripts')
        <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
"></script>
        <script>
            $(function () {
                document.addEventListener("DOMContentLoaded", function () {
                    const buttons = document.querySelectorAll(".filter-button");

                    buttons.forEach(button => {
                        button.addEventListener("click", function () {
                            buttons.forEach(btn => btn.classList.remove("active"));
                            this.classList.add("active");

                            const academyId = this.getAttribute("data-academy");
                            fetch(`/getFilteredData/${academyId}`)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    updateContent(data);
                                })
                                .catch(error => console.error("Error fetching data: ", error));
                        });
                    });
                });


                $('a.options').on('click', function (e) {
                    e.preventDefault();
                    this.closest('form').submit();
                });
                $('body').on('click', `a[id^='show_more']`, function (e) {
                    e.preventDefault();

                    let id = $(this).attr('data-id');

                    $(`#short_bio${id}`).fadeOut();
                    $(`#long_bio${id}`).fadeIn();
                    $(this).hide(); // Hide the "Show More" link
                    $(`#show_less${id}`).show(); // Show the "Show Less" link
                });

                $('body').on('click', `a[id^='show_less']`, function (e) {
                    e.preventDefault();

                    let id = $(this).attr('data-id');

                    $(`#long_bio${id}`).fadeOut();
                    $(`#short_bio${id}`).fadeIn();
                    $(this).hide(); // Hide the "Show Less" link
                    $(`#show_more${id}`).show(); // Show the "Show More" link
                });


                $('.inBtn').on('click', function (e) {
                    e.preventDefault();
                    let $form = $(this).closest('form'); // Get the form associated with the clicked button
                    let project_id = $form.find('input[name="project_id"]').val();

                    Swal.fire({
                        title: 'Apply for a project',
                        html: `
        <div class="form-floating">
            <textarea class="form-control" placeholder="Why do you want to apply?" id="message" name="message" style="height: 220px; resize:none;"></textarea>
        </div>
    `,
                        showCancelButton: true,
                        confirmButtonText: 'Apply',
                        preConfirm: () => {
                            const message = Swal.getPopup().querySelector('#message').value;
                            if (!message) {
                                Swal.showValidationMessage('Please provide a message.');
                            }
                            return {message: message};
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value && result.value.message) {
                            // Extract the message from the result object
                            let message = result.value.message;

                            // Send the data to the controller using Ajax
                            $.ajax({
                                url: $form.attr('action'),
                                type: 'POST',
                                data: {
                                    '_token': $('meta[name="csrf-token"]').attr('content'),
                                    'project_id': project_id,
                                    'message': message
                                },
                                dataType: 'json', // Expect JSON response from the controller
                                success: function (response) {
                                    // Handle the successful response from the controller
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'You applied successfully.',
                                        icon: 'success',
                                    }).then(() => {
                                        // Redirect to the dashboard after successful application
                                        window.location.href = "{{ route('dashboard') }}";
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.log(xhr); // Log the error details in the browser console

                                    // Handle the error response from the controller
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while applying.',
                                        icon: 'error',
                                    });
                                }
                            });
                        }
                    });
                });


            });
        </script>
    @endsection
</x-app-layout>
