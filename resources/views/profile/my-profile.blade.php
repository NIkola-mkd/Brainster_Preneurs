@extends('layouts.master')

@section('title','My profile')

@section('css')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@include('layouts.navbar')

@section('content')
<div class="container-fluid">
    <div class="my-5 mx-5">
        <div class="row">
            <div class="col-4">
                <h1>My Profile</h1>
            </div>
            <div class="col-7 offset-1">
                <h1>Skills</h1>
            </div>
        </div>
        <form action="">
            <div class="row">
                <div class="col-4">
                    <div class="row my-5">
                        <div class="col-6">
                            @if($user->image == null)
                            <img class="avatar-user img-thumbnail" src="{{ asset('avatars/default_avatar.png') }}">
                            <figcaption class="gray-custom">Click here to upload an image</figcaption>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                </div>
                                <div class="row mb-3">
                                    @error('name')
                                    <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
                                </div>
                                <div class="row mb-3">
                                    @error('surname')
                                    <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                </div>
                                <div class="row mb-3">
                                    @error('email')
                                    <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 offset-1">
                    <div class="row my-5">
                        <div class="col-12 skill-cards">
                            @foreach($skills as $skill)
                            <input type="checkbox" class="btn-check" id="#{{$skill->id}}" autocomplete="off" name="skills[{{$skill->id}}]">
                            <label class="font-size-skills btn-width col-1 m-1 btn btn-outline-success p-4 rounded" for="#{{$skill->id}}">{{$skill->name}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>

        </form>
    </div>
</div>
</div>
@endsection