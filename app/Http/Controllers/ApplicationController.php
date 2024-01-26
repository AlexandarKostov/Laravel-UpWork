<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('application.index', [
            'applicants' => Application::where('user_id', Auth::id())->latest()->paginate(8),
        ]);
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'project_id' => 'required|integer',
            'message' => 'required|string|max:500',
        ]);

        try {
            // Create a new application record
            $application = new Application();
            $application->user_id = auth()->user()->id;
            $application->project_id = $request->project_id;
            $application->message = $request->message;
            $application->save();

            // Return a success response
            return response()->json(['message' => 'Application submitted successfully.']);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json(['message' => 'Error occurred while submitting the application.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $application): View
    {
        return view('application.show', [
            'projects' => $application
        ]);
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
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $application = $request->application;
        $applicantArr = $request->applicantArr;

        // Update the 'assembled' status of the project to 1
        DB::table('projects')
            ->where('id', '=', $application)
            ->update(['assembled' => 1]);

        // Update the 'accepted' status of the selected applicants to 1
        DB::table('applications')
            ->whereIn('user_id', $applicantArr)
            ->where('project_id', '=', $application)
            ->update(['is_accepted' => 1]);

        // Update the 'accepted' status of the non-selected applicants to 0
        DB::table('applications')
            ->whereNotIn('user_id', $applicantArr)
            ->where('project_id', '=', $application)
            ->update(['is_accepted' => 0]);

        return response()->json(['message' => 'Team successfully assembled']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
