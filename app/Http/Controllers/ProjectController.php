<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Academy;
use App\Models\Project;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::where('projects.user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $author = User::where('users.id', Auth::user()->id)
            ->join('academies', 'academies.id', 'users.academy_id')
            ->select('users.name as name', 'academies.id', 'users.academy_id', 'users.surname as surname', 'users.image as avatar', 'academies.profession as profession')
            ->get();


        return view('projects.my-projects', compact('projects', 'author'));
    }

    public function all()
    {
        $academies = Academy::all();

        return view('dashboard', compact('academies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academies = Academy::all();

        return view('projects.create-project', compact('academies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->user_id = Auth::user()->id;


        if ($project->save()) {
            $project->academies()->sync($request->academies);
            return redirect()->route('my-projects')->with('success', 'Project created! ');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $academies = Academy::all();

        $author = Auth::user()->id;

        if (($project->user_id != $author))
            abort(404);

        $project_academy = $project->academies()->pluck('academy_id')->toArray();

        return view('projects.edit-project', compact('project', 'academies', 'project_academy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::find($id);

        $project->title = $request->title;
        $project->description = $request->description;

        if ($project->save()) {
            $project->academies()->sync($request->academies);
            return redirect()->route('my-projects')->with('success', 'Project edited! ');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $author = Auth::user()->id;

        if (($project->user_id != $author))
            abort(404);

        Project::where('id', $id)->delete();

        $project->academies()->detach();
        $project->users()->detach();

        return redirect()->route('my-projects')->with('success', 'Project deleted! ');
    }

    public function myApplications()
    {
        $projects = Project::with('academies', 'author', 'users')
            ->withCount('users')
            ->whereHas('users', function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($projects);
        return view('applications.my-applications', compact('projects'));
    }

    public function cancel($id)
    {

        $projects = Project::find($id);

        $project_check = Project::where('id', $id)
            ->whereHas('users', function ($query) {
                return $query->where('user_id', Auth::user()->id)
                    ->where('status', 'denied')
                    ->orWhere('status', 'request');
            })->value('id');

        // $project->users()->wherePivot('user_id', Auth::user()->id)
        //     ->wherePivot('status', 'denied')
        //     ->wherePivot('status', 'request')->detach();


        if ($project_check == $id) {
            $projects->users()->wherePivot('user_id', Auth::user()->id)->detach();
            return redirect()->back();
        } else {
            abort(404);
        }
    }
}
