<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Academy;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, User $user): JsonResponse
    {
        $profile = $user->update($request->all());

        foreach ($request->input('skill') as $skill) {
            DB::table('skill_user')->insert([
                'skill_id' => $skill,
                'user_id' => $request->input('user_id')
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new ProfileResource($profile)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
