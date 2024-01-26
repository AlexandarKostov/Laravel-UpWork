@extends('layouts.guest')
<x-app-layout xmlns="http://www.w3.org/1999/html">
    <div class="min-h-screen p-6"> <!-- Add some padding to the whole content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left column -->
            <div class="col-6 flex justify-center items-center">
                <div class="ml-4">
                    <p class="font-semibold mb-0">{{ $projects->name }} - Applicants</p>
                    <p class="font-semibold flex items-center">
                        Choose your teammates
                        <img src="{{ asset('icons/4.png') }}" class="ms-3" width="30" height="30" alt="...">
                    </p>
                </div>
            </div>

            <!-- Right column -->
            <div class="col-6 flex justify-center items-center">
                <div class="text-center">
                    <p class="text-sm text-gray-400">Ready to start?<br>Click on the button below.</p>
                    <button id="assembleTo" data-application="{{ $projects->id }}"
                            class="uppercase color-orange inline-flex items-center px-4 py-2 text-white rounded-md text-sm font-semibold">
                        TEAM assembled
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                             class="bi bi-check2" viewBox="0 0 16 16">
                            <path
                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Center the cards and adjust their size -->
        <div class="mt-20 col-12 grid grid-cols-1 md:grid-cols-3 gap-4 justify-center items-center">
            <!-- Add some margin-top -->
            @foreach($projects->applications as $applicant)
                <div class="mb-4 max-w-sm mt-10 card-wrapper"> <!-- Set a maximum width to control card size -->
                    <div class="card rounded-lg border border-white bg-white shadow-sm">
                        <div class="card-body text-center px-3 py-4">
                            <div class="flex flex-col items-center mb-3"> <!-- Image, Name, Email container -->
                                <img src="{{ $applicant->user->Avatar() }}"
                                     class="rounded-full border-4 border-white bg-body p-1 shadow-sm card-image"
                                     width="100" height="100"
                                     alt="Profile Picture">
                                <a href="{{ route('profile.show', $applicant->user->id) }}" target="_blank"
                                   class="font-semibold text-dark text-decoration-none mt-2">{{ $applicant->user->name }} {{ $applicant->user->surname }}</a>
                                <a href="mailto:{{ $applicant->user->email }}"
                                   class="text-gray font-semibold text-decoration-none">{{ $applicant->user->email }}</a>
                            </div>
                            <div class="text-center mb-3"> <!-- Description container -->
                                <p class="mt-2">{{ $applicant->message }}</p>
                            </div>
                            <div class="mb-4 max-w-sm">
                                <input type="checkbox"
                                       class="filter-checkbox opacity-0 absolute top-0 start-0"
                                       id="appSelect{{ $applicant->user->id }}" name="appSelect"
                                       data-user="{{ $applicant->user->id }}" autocomplete="off">
                                <label class="btn flex justify-center cursor-pointer"
                                       for="appSelect{{ $applicant->user->id }}"><img
                                        src="{{ asset('icons/1.png') }}" width="30" height="30" alt="..."></label>
                                <div class="card rounded-lg border border-white bg-white shadow-sm">
                                    <!-- Rest of the card content here -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
        <script>
            const checkboxes = document.querySelectorAll('.filter-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', (event) => {
                    const cardWrapper = event.target.closest('.card-wrapper');
                    if (event.target.checked) {
                        cardWrapper.querySelector('.card').style.opacity = '0.6';
                    } else {
                        cardWrapper.querySelector('.card').style.opacity = '1';
                    }
                });

                // Handle the icon click without jumping to the top
                const icon = checkbox.nextElementSibling;
                icon.addEventListener('click', (event) => {
                    checkbox.click(); // Manually trigger the checkbox click event
                    event.preventDefault(); // Prevent the default anchor tag behavior
                });
            });
            const cardWrappers = document.querySelectorAll('.card-wrapper');

            // Track the selected applicants
            const applicantArr = [];

            cardWrappers.forEach(cardWrapper => {
                const checkbox = cardWrapper.querySelector('.filter-checkbox');
                const card = cardWrapper.querySelector('.card');

                // Add event listener to each card wrapper to handle selections
                cardWrapper.addEventListener('click', () => {
                    checkbox.click(); // Manually trigger the checkbox click event

                    if (checkbox.checked) {
                        card.style.opacity = '0.6';
                        applicantArr.push(checkbox.dataset.user);
                    } else {
                        card.style.opacity = '1';
                        const index = applicantArr.indexOf(checkbox.dataset.user);
                        if (index > -1) {
                            applicantArr.splice(index, 1);
                        }
                    }
                });
            });

            // Handle the "TEAM assembled" button click
            $('#assembleTo').on('click', function (e) {
                e.preventDefault();

                let application = $(this).attr('data-application');

                if (isNaN(application)) {
                    return;
                }

                if (applicantArr.length === 0) {
                    Swal.fire('Error', 'You need to select at least one candidate', 'error');
                    return;
                }

                $.ajax({
                    method: 'PUT',
                    url: `${application}`,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        application,
                        applicantArr
                    },
                    success: (response) => {
                        if (response.auth) {
                            Swal.fire('Team assembling', `${response.message}`, 'info').then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/project';
                                }
                            });
                        }
                    },
                    error: (error) => {
                        let errors = error.responseJSON;
                        Swal.fire('Error', errors.message, 'error');
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>


