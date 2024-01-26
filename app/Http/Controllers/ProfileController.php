<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Academy;
use App\Models\Skill;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile): View
    {
        return view('profile.show', [
            'user' => $profile,
            'skills' => Skill::all(),
            'academies' => Academy::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $skills = Skill::all();
        $academies = Academy::all();
        return view('profile.edit', compact('skills', 'academies', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(ProfileRequest $request, User $profile): \Illuminate\Http\RedirectResponse
    {
        if (!auth()->check() || $profile->id !== \auth()->id()) {
            return redirect()->route('dashboard')->with(['message' => 'You can only update your profile']);
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/profiles', 'public');
            if ($profile->image) {
                \Illuminate\Support\Facades\File::delete(public_path('storage/' . $profile->image));
            }
            $profile->image = $imagePath;
        }
        $profile->name = $request->name;
        $profile->surname = $request->surname;
        $profile->email = $request->email;
        $profile->short_bio = $request->short_bio;
        $profile->is_edited = 1;
        $profile->academy_id = $request->academy;
        $profile->academy()->associate($request->academy);

        $profile->save();
        $profile->skills()->sync($request->skill);
        return redirect()->route('dashboard', compact('profile'))->with(['message' => 'Profile successfully updated']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
