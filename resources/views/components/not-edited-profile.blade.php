@if(\Illuminate\Support\Facades\Auth::user()->is_edited === 0 && request()->routeIs('dashboard'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-black">
                <p class="font-semibold text-center">Welcome!</p>
                <div class="text-center font-semibold">Please finish up your profile on the following <a
                        href="{{ route('profile.edit', ['profile' => Auth::id()]) }}" class="text-orange-400">link</a>,
                    so that you
                    can
                    enjoy all
                    our features.
                </div>
            </div>
        </div>
    </div>
@endif
