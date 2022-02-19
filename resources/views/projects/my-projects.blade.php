@extends('layouts.master')

@section('css')
<link href="{{ asset('css/my-projects.css') }}" rel="stylesheet">
@endsection

@section('title','My Projects')

@include('layouts.navbar')

@section('content')
<div class="container-fluid">
    <div class="container mt-5">
        <div class="col-6 offset-3">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="mx-3">
        <div class="mt-5">
            <h5>Have a new idea to make the world better?</h5>
            <h3 class="mt-3">Create new project
                <span><a href="/projects/create-project"><img src="{{asset('custom_icons/1.png')}}" alt="" class="add-new-button "></a></span>
            </h3>
        </div>
    </div>
</div>
<div class="container-fluid mt-5">
    <!-- project cards -->
    <div class="container mt-5">
        @foreach($projects as $project)
        <div class="col-lg-10 col-md-10 col-12 my-7 mx-auto">
            @foreach($author as $a)
            <div class="card mb-3 rounded mt-5 ">
                <div class="row g-0">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="col-3 mx-auto">
                            <div class="card-image">
                                <img src="{{ asset('avatars/'. $a->avatar ) }}" class=" mx-auto project-image" alt="...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-5  text-center semi-bold-bolder">{{$a->name}} {{$a->surname}}</p>
                                    <p class="mt-1 orange-custom classic-bold text-center ">I'm {{$a->profession}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="card-body ">
                            <h5 class="card-title classic-bold">{{$project->title}}</h5>
                            <p class="classic mt-3 showMore">{{$project->description}}</p>
                            <button class="applicants btn btn-outline-success p-lg-1 p-md-1 p-0">
                                <span class="font-applicants classic-bold">{{$project->users()->count()}}</span>
                                <p class="font-applicants classic">applicants</p>
                            </button>
                            <div class="edit-delete">
                                <a href="{{route('edit-project',$project->id)}}">
                                    <img src="{{asset('custom_icons/8.png')}}" alt="" class="action-icon my-1">
                                </a>
                                <br>
                                <a href="">
                                    <img src="{{asset('custom_icons/7.png')}}" alt="" class="action-icon my-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="row g-0 mb-1">
                        <div class="col-lg-8 col-md-7 col-12 ">
                            <div class="row mt-4 mx-auto">
                                <div class="col-6 text-center">
                                    <span class="gray-custom semi-bold-bolder text-center">I'm looking for</span>
                                </div>
                                <div class="col-12 mt-2">
                                    @foreach($project->academies as $academy)
                                    <span class="text-wrap academies-circles text-white text-center semi-bold bg-green-custom p-3">{{$academy->name}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($project->is_assembled == true)
                        <div class="col-4">
                            <img src="{{asset('custom_icons/assembled.png')}}" class="assembled " alt="">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


@section('js')
<script src="{{asset('js/readMoreLess.js')}}"></script>
<script src="{{asset('js/onHover.js')}}"></script>
@endsection