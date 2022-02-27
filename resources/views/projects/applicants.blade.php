@extends('layouts.master')

@section('css')
<link href="{{ asset('css/applicants.css') }}" rel="stylesheet">
@endsection

@section('title','My Projects')

@include('layouts.navbar')

@section('content')
<div class="container-fluid my-5">
    <div class="container">
        <div class="row">
            <div class="col-6">
                @foreach($details as $detail)
                <h3 class="semi-bol-bolder">{{$detail->title}} - Applicants</h3>

                <h5 class="classic-bold mt-3">Choose your teammates
                    <img class="icon ms-lg-5" src="{{asset('custom_icons/4.png')}}" alt="">
                </h5>
            </div>
            <div class="col-lg-6 col-md-4">
                <p class="text-lg-end gray-custom">Ready to start?</p>
                <p class="text-lg-end gray-custom">Click on the button bellow
                </p>
                <div class="col-lg-6 offset-lg-9">
                    <form action="{{route('project-assemble', $detail->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-warning">TEAM ASSEMBLED <span class="fs-5 text">&#10003;</span></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row mx-auto mt-5">
            <div class="col-8 mx-auto">
                <div class="row">
                    @foreach($details as $detail)
                    <input type="text" value="{{$detail->id}}" hidden id="projectID">
                    @foreach($detail->users as $user)
                    <div class="col-lg-4 col-md-8 col-12 d-flex align-items-stretch mt-5 mx-auto">
                        <div class="card rounded  {{$user->pivot->status == 'accepted' ? 'accepted' : ''}} " style="width: 18rem;">
                            <div class="col-md-3 col-4 mx-auto">
                                <img src="{{asset('avatars/'. $user->image)}}" class="avatar-applicants" alt="...">
                            </div>
                            <div class="card-body text-center mt-5">
                                <a class="text-decoration-none black-custom" href="{{route('applicant-profile',['id' => $user->id, 'name'=> $user->name, 'surname'=>$user->surname])}}">
                                    <h5 class="semi-bold-bolder">{{$user->name}} {{$user->surname}}</h5>
                                </a>
                                <h6 class="orange-custom classic-bold ">{{$user->academies->profession}}</h6>
                                <span class="classic gray-custom">{{$user->email}}</span>
                                <p class="classic">{{$user->pivot->message}}</p>
                                <button id="{{$user->id}}" class="btn apply" {{$user->pivot->status == 'accepted' ? 'disabled' : '' }}><a href="" class="disabled"><img class="icon-add" src="{{asset('custom_icons/1.png')}}" alt=""></a></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/applicants.js')}}"></script>
@endsection