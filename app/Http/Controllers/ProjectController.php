<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Academy;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('project.index', [
            'projects' => Project::where('user_id', Auth::id())->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $academies = Academy::all();
        return \view('project.create', compact('academies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): \Illuminate\Http\RedirectResponse
    {

        $project = Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'academy_id' => $request->academy_id,
        ]);
        $project->profiles()->sync($request->academy);

        return redirect()->route('project.index')->with(['message' => 'Project successfully created']);
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
    public function edit(Project $project): View
    {
        return view('project.edit', [
            'project' => $project,
            'academies' => Academy::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->user_id = Auth::id();
        $project->name = $request->name;
        $project->description = $request->description;

        $project->save();

        $project->profiles()->sync($request->academy);

        return to_route('project.index')->with(['message' => 'Project successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->profiles()->detach($project->profiles);
        $project->applications()->delete();
        $project->delete();

        return to_route('project.index')->with(['message' => 'Project successfully deleted']);
    }
}
