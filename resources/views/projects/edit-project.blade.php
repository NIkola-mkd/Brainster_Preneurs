@extends('layouts.master')

@section('css')
<link href="{{ asset('css/create_edit_projects.css') }}" rel="stylesheet">
@endsection

@section('title','My Projects')

@include('layouts.navbar')

@section('content')
<div class="container-fluid">
    <div class="mt-5 mx-3">
        <form action="{{ route('project-edit', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mt-3">

                <div class="col-lg-6 col-8 mt-3 ">
                    <h3>Edit Project</h3>
                    <div class="col-lg-4 col-12">
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Name of the project" value="{{$project->title}}">
                            </div>
                            <div class="row mb-3">
                                @error('title')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-12 mt-5 mt-lg-0">
                        <div class="col-12  mt-lg-1 mt-5">
                            <label for="description" class="classic text-secondary fw-bold ">Description of the project</label>
                            <textarea class="form-control my-3" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt quis ante sed tempus. Cras imperdiet, quam ac fringilla venenatis, lectus nisl sagittis quam, eget tincidunt velit nibh at dui. Sed vel libero feugiat, luctus lacus at, fringilla sem. Nam tincidunt tortor velit, in porta dolor ullamcorper quis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. " id="description" name="description">{{$project->description}}</textarea>
                            <div class="row mb-3">
                                @error('description')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mt-3">
                    <h3>What I need </h3>
                    <div class="col-8 ">
                        @foreach($academies as $academy)
                        <input type="checkbox" class="btn-check" id="#{{$academy->name}}" autocomplete="off" name="academies[]" value="{{$academy->id}}" {{ in_array($academy->id,$project_academy) ?'checked':'' }}>
                        <label class="font-size-skills btn-block m-1 btn btn-outline-success p-4 rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                        @endforeach
                        <p class="red-custom mt-2 text-end">Please select no more than 4 options</p>
                    </div>
                    <div class="row mb-3">
                        @error('academies')
                        <span class="red-custom semi-bold mt-1"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mt-1">
                            <div class="col-2 mx-auto">
                                <button type="submit" class="submit-width btn btn-lg bg-green-custom text-white px-4 round">EDIT</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/textarea.js') }}"></script>
@endsection