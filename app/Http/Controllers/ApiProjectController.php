<?php

namespace App\Http\Controllers;

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

        if ($project->save()) {
            $project->users()->attach($user, ['message' => $msg]);
            return response()->json(['success' => true, 'message' => 'You applied for the project']);
        }

        return response()->json(['error' => true, 'message' => 'Please try again']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
