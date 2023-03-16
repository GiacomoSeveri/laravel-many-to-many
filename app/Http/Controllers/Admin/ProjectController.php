<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use App\Models\Lenguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Validator;

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
        $lenguage = Lenguage::all();
        return view('admin.projects.create', compact('project', 'categories', 'lenguage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|unique:projects',
                // 'category_id' => 'nullable|exist:categories,id',
                'image' => 'nullable|image|mimes:jpeg,jpg,png',
                'content' => 'required|string',
                // 'tag[]' => 'nullable|exist:lenguage,id'
            ],
            [
                'title.required' => 'il titolo è obbligatorio.',
                'title.unique' => "esiste già un post con questo titolo: $request->title.",
                'content.required' => 'non hai messo nussana descrizione',
                'image.image' => 'l\'immagine deve essere un file immagine',
                'image.mimes' => 'le estenzioni accettate sono: jpeg, jpg, png',
                // 'category_id' => 'categoria non valida',
                // 'tag[]' => 'i tag selezionati non sono validi'
            ]
        );

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
        // @dd($data);
        if (Arr::exists($data, 'lenguages')) $project->lenguages()->attach($data['lenguages']);

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
        $lenguage = Lenguage::all();

        $project_leng = $project->lenguages->pluck('id')->toArray();

        // @dd($project_leng);

        return view('admin.projects.edit', compact('project', 'categories', 'lenguage', 'project_leng'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => 'required|string|',
                // 'category_id' => 'nullable|exist:categories,id',
                'image' => 'nullable|image|mimes:jpeg,jpg,png',
                'content' => 'required|string',
                // 'tag[]' => 'nullable|exist:lenguage,id'
            ],
            [
                'title.required' => 'il titolo è obbligatorio.',
                'content.required' => 'non hai messo nussana descrizione',
                'image.image' => 'l\'immagine deve essere un file immagine',
                'image.mimes' => 'le estenzioni accettate sono: jpeg, jpg, png',
                // 'category_id' => 'categoria non valida',
                // 'tag[]' => 'i tag selezionati non sono validi'
            ]
        );

        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('project', $data['image']);
            $data['image'] = $img_url;
        }

        $project->update($data);

        if (Arr::exists($data, 'lenguages')) $project->lenguages()->sync($data['lenguages']);
        else $project->lenguages()->detach();

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
