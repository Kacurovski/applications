<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use DrewM\MailChimp\MailChimp;
use App\Services\MailchimpService;
use App\Http\Requests\LoginRequest;
use App\Mail\ContactInformationMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\Facades\Newsletter;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAuth();
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $this->checkAuth();
        Project::create($request->validated());
        return redirect()->route('projects.create')->with('message', 'Продуктот е успешно додаден');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {   
        $this->checkAuth();
        $project->update($request->validated());
        $projects = Project::all();
        return redirect()->route('projects.editMode', compact('projects'))->with('message', 'project successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->checkAuth();
        $project->delete();
        return redirect()->route('projects.editMode')->with('message', 'Проектот е успешно избришан');
    }

    public function editMode()
    {
        $this->checkAuth();
        $projects = Project::all();
        return view ('projects.edit_mode', compact('projects'));
    }

    private function checkAuth(){
        if(!session()->has('admin_id')){
            return redirect()->route('projects.index');
        }
    }
}
