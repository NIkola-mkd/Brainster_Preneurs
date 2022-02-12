<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Academy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academies = Academy::all();

        $skills = Skill::all();

        $user = User::find(Auth::user()->id);

        $user_skills = $user->skills()->get();


        return view('profile.my-profile', compact('user', 'skills', 'academies', 'user_skills'));
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
    public function update(ProfileRequest $request)
    {
        // get image random name
        $rand = Str::random(100);
        $img = $rand . '.' . $request->image->extension();
        $request->image->move(public_path('avatars'), $img);

        $user = User::find(Auth::user()->id);

        // update user table
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->image = $img;
        $user->biography = $request->biography;
        $user->academy_id = $request->academy;

        // attach skills to pivot table 
        $user->skills()->attach($request->skills);

        $user->save();

        return redirect()->back()->with('success', 'Profile updated');
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
