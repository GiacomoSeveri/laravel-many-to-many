<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $categories = Category::all();
        return view('admin.projects.create', compact('project', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        $project = new Project();

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('project', $data['image']);
            $data['image'] = $img_url;
        }

        $project->fill($data);
        $project->save();

        return  to_route('admin.projects.show', compact('project'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $categories = Category::all();

        return view('admin.projects.show', compact('project', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('project', $data['image']);
            $data['image'] = $img_url;
        }

        $project->update($data);

        return to_route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::findOrFail($id);

        if ($projects->image) Storage::delete($projects->image);

        $projects->delete();

        return to_route('admin.projects.index');
    }
}
