<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Academy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\File;

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

        $user_skills = $user->skills()->pluck('skill_id')->toArray();

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
    public function show($id, $name, $surname)
    {
        $user = User::find($id)
            ->with('skills')
            ->whereHas('skills', function ($query) use ($id) {
                return $query->where('user_id', $id);
            })
            ->get();

        return view('applicants.applicant-profile', compact('user'));
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
        $user = User::find(Auth::user()->id);

        if ($request->hasFile('image')) {

            $directory = 'avatars/' . $user->image;
            if (File::exists($directory)) {

                File::delete($directory);
            }
            // get image random name
            $rand = Str::random(100);
            $img = $rand . '.' . $request->image->extension();
            $request->image->move(public_path('avatars'), $img);
            $user->image = $img;
        }
        // update user table
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->biography = $request->biography;
        $user->academy_id = $request->academy;

        // attach skills to pivot table (user_skill table)
        $user->skills()->sync($request->skills);

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
