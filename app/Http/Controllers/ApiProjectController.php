<?php

namespace App\Http\Controllers;

use App\Events\MailEvent;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $category = $request->category;

        if ($request->ajax()) {
            if ($category == 'all') {
                $projects = Project::with('academies', 'author', 'users')
                    ->withCount('users')
                    ->where('projects.user_id', '!=', Auth::user()->id)
                    ->where('projects.is_assembled', 0)
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

                return response()->json($projects);
            } else {
                $project = Project::with('author', 'academies', 'users')
                    ->withCount('users')
                    ->whereHas('academies', function ($query) use ($category) {
                        return $query->where('academy_id', '=', $category);
                    })
                    ->where('projects.user_id', '!=', Auth::user()->id)
                    ->where('projects.is_assembled', 0)
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

                return response()->json($project);
            }
        }
    }


    public function apply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required'
        ]);
        $user = Auth::user()->id;
        $msg = $request->message;
        $id = $request->id;

        $project = Project::find($id);

        $project_author = Project::find($id)->with('author')->first();
        $applicant = User::find($user)->with('skills')->first();
        $email = $project_author->author->email;
        $title = $project_author->title;
        $skills = $applicant->skills->pluck('name');
        $skills = $skills->toArray();
        $name = $applicant->name . ' ' . $applicant->surname;


        if ($project->save()) {
            event(new MailEvent($email, $name, $title, $skills, $msg));
            $project->users()->attach($user, ['message' => $msg]);
            return response()->json(['success' => true, 'message' => 'You applied for the project']);
        }

        return response()->json(['error' => true, 'message' => 'Please try again']);
    }

    public function accept(Request $request, $id)
    {
        $user = $request->user_id;
        $project = Project::find($id);

        if ($project->save()) {
            $project->users()->updateExistingPivot($user, ['status' => 'accepted']);
            return response()->json(['success' => true, 'message' => 'User accepted']);
        }

        return response()->json(['error' => true, 'message' => 'Error']);
    }
}
