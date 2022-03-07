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
     * Display user projects
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

    /**
     * display all academies as filter 
     *buttons on dashboard page
     */

    public function all()
    {
        $academies = Academy::all();

        return view('dashboard', compact('academies'));
    }

    /**
     * Create ne project page .
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academies = Academy::all();

        return view('projects.create-project', compact('academies'));
    }

    /**
     * Sotre new project in db .
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
     * edit project blade
     
     * list all data 
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
     * Update project .
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
     * Delete project .
     * only for authenticated users 
     * check if the user is author of the project
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

    /**
     * my applictions view page
     * list project data
     */

    public function myApplications()
    {
        $projects = Project::with('academies', 'author', 'users')
            ->withCount('users')
            ->whereRelation('users', 'user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('applications.my-applications', compact('projects'));
    }

    /**
     * cancel if application is denied 
     * check application status
     * check if user applied for the project
     */

    public function cancel($id)
    {

        $projects = Project::find($id);

        $project_check = Project::where('id', $id)
            ->whereHas('users', function ($query) {
                return $query->where('user_id', Auth::user()->id)
                    ->where('status', 'denied')
                    ->orWhere('status', 'request');
            })->value('id');

        if ($project_check == $id) {
            $projects->users()->wherePivot('user_id', Auth::user()->id)->detach();
            return redirect()->back();
        } else {
            abort(404);
        }
    }

    /**
     * list applicants data
     */

    public function applicants($id)
    {
        $details = Project::with('users')
            ->where('user_id', Auth::user()->id)
            ->whereHas('users', function ($query) use ($id) {
                return $query->where('project_id', $id);
            })->get();

        return view('projects.applicants', compact('details'));
    }

    /**
     * update project status
     * table (projects) 
     * column (is_assembled)
     */
    public function assemble($id)
    {
        $project = Project::find($id);

        $project->is_assembled = true;

        $denied = $project->users()->where('status', 'request')->pluck('id');

        if ($project->save()) {
            $project->users()->updateExistingPivot($denied, ['status' => 'denied']);
            return redirect()->back()->with('success', 'Team assembled! ');
        }

        return redirect()->back()->with('error', 'Error! ');
    }
}
