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

        // if ($request->ajax() == 'all') {
        $projects = Project::with('academies', 'author', 'users')
            ->withCount('users')
            ->where('projects.user_id', '!=', 1)
            ->where('projects.is_assembled', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        // }
        return response()->json($projects);
        // } 
        // else {
        //     $project = Project::with('author', 'academies')
        //         ->withCount('users')
        //         ->whereHas('academies', function ($query) {
        //             return $query->where('academy_id', '=', 1);
        //         })
        //         ->where('projects.user_id', '!=', Auth::user()->id)
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(3);

        //     return response()->json($project);
        // }
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
