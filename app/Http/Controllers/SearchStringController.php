<?php

namespace App\Http\Controllers;

use App\Models\SearchString;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Term;
use App\Models\Synonym;

class SearchStringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_project)
    {
        $project = Project::findOrFail($id_project);
        $terms = $project->terms;
        $synonyms = $project->synonyms;
       
        return view('planning.search-string', compact('project', 'terms', 'synonyms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_term(Request $request, $id_project)
    {
        $project = Project::findOrFail($id_project);

        $project->terms()->create([
            'description' => $request->input('description_term'),
        ]);

        return redirect("/planning/".$id_project."/search-string");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_synonym(Request $request, $id_project)
    {
        $id_term = $request->input('termSelect');
        $term = Term::findOrFail($id_term);
        $term->synonyms()->create([
            'description' => $request->input('description_synonym'),
        ]);
     
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SearchString $searchString)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SearchString $searchString)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SearchString $searchString)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SearchString $searchString)
    {
        //
    }
}
