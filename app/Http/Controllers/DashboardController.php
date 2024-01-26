<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Application;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class DashboardController extends Controller
{

//    public function getFilteredData($academyId): \Illuminate\Http\JsonResponse
//    {
//        if ($academyId === 'all') {
//            $filteredData = Project::all();
//        } else {
//            // Assuming 'academy_id' is the column name in the pivot table 'academy_project'
//            $filteredData = Project::whereHas('academies', function ($query) use ($academyId) {
//                $query->where('academy_id', $academyId);
//            })->get();
//        }
//
//        return response()->json($filteredData);
//    }

    public function checkApplication(Request $request): \Illuminate\Http\JsonResponse
    {
        $project_id = $request->input('project_id');
        $user_id = auth()->user()->id;

        // Check if the user has already applied for the project
        $applied = Application::where('project_id', $project_id)
            ->where('user_id', $user_id)
            ->exists();

        return response()->json(['applied' => $applied]);
    }


//    public function getPaginatedProjects(Request $request): \Illuminate\Http\JsonResponse
//    {
//        Paginator::currentPageResolver(function () use ($request) {
//            return $request->input('page', 1);
//        });
//
//        $projects = Project::with('applications')->latest()->where('assembled', 0)->paginate(8);
//
//        return response()->json($projects);
//    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = Project::latest()->where('assembled', 0)->paginate(8);
        return view('dashboard.dashboard', [
            'projects' => $projects,
            'skills' => Skill::all(),
            'academies' => Academy::all(),
            'users' => User::all()
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
