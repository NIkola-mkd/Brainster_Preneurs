@extends('layouts.master')

@include('layouts.navbar')

@section('title','My applications')

@section('css')
<link href="{{ asset('css/my-applications.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-5">
    <!-- project cards -->
    <div class="container mt-5">
        @foreach($projects as $project)
        <div class="col-lg-10 col-md-10 col-12 my-7 mx-auto">
            <div class="card mb-3 rounded mt-5 ">
                <div class="row g-0">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="col-3 mx-auto">
                            <div class="card-image">
                                <img src="{{ asset('avatars/'. $project->author->image ) }}" class=" mx-auto project-image" alt="...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-5  text-center semi-bold-bolder">{{$project->author->name}} {{$project->author->surname}}</p>
                                    <p class="mt-1 orange-custom classic-bold text-center ">I'm {{$project->author->academies->profession}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="card-body ">
                            <h5 class="card-title classic-bold">{{$project->title}}</h5>
                            <p class="classic mt-3 showMore">{{$project->description}}</p>
                            <button class="applicants btn btn-outline-success p-lg-1 p-md-1 p-0">
                                <span class="font-applicants classic-bold">{{$project->users_count}}</span>
                                <p class="font-applicants classic">applicants</p>
                            </button>
                            <div class="edit-delete">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="row g-0 mb-1">
                        <div class="col-lg-10 col-md-12 col-12 ">
                            <div class="row mt-4 mx-auto">
                                <div class="col-lg-6 col-md-5 col-12 mt-lg-5 d-md-none d-block">
                                    @foreach($project->users as $status)
                                    @if($status->pivot->status == 'approved')
                                    <p class="ms-2 green-custom semi-bold-bolder">Application Accepted
                                        <img class="action-icon" src="{{asset('custom_icons/5.png')}}" alt="">
                                    </p>
                                    @elseif($status->pivot->status == 'denied')
                                    <p class="ms-2 green-custom semi-bold-bolder">Application Denied
                                        <img class="action-icon" src="{{asset('custom_icons/6.png')}}" alt="">
                                    </p>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-6 text-center">
                                    <span class="gray-custom semi-bold-bolder text-center">I'm looking for</span>
                                </div>
                                <div class="col-lg-6 col-md-5 col-12 mt-lg-5 d-md-block d-none">
                                    @foreach($project->users as $status)
                                    @if($status->pivot->status == 'approved')
                                    <p class="ms-2 green-custom semi-bold-bolder">Application Accepted
                                        <img class="action-icon" src="{{asset('custom_icons/5.png')}}" alt="">
                                    </p>
                                    @elseif($status->pivot->status == 'request')
                                    <p class="ms-2 red-custom semi-bold-bolder">Application Denied
                                        <img class="action-icon" src="{{asset('custom_icons/6.png')}}" alt="">
                                    </p>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-lg-8 col-12 mt-2 ">
                                    @foreach($project->academies as $academy)
                                    <span class="text-wrap academies-circles text-white text-center semi-bold bg-green-custom p-lg-3 p-2">{{$academy->name}}</span>
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
<script src="{{ asset('js/readMoreLess.js') }}"></script>
@endsection