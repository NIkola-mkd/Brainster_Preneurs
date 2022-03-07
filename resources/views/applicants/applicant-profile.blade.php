@extends('layouts.master')

@section('css')
<link href="{{ asset('css/applicant_profile.css') }}" rel="stylesheet">
@endsection

@section('title','My Projects')

@include('layouts.navbar')

@section('content')
<div class="conatiner-fluid mt-5">
    <div class="row ms-5 mt-5">
        <div class="col-md-6 col-12">
            @foreach($user as $u)
            <div class="row">
                <div class="col-md-6 col-12">
                    <img src="{{asset('avatars/'. $u->image)}}" class="avatar-applicants img-thumbnail">
                </div>
                <div class="col-6 mt-5">
                    <h4 class="gray-custom semi-bold">Name</h4>
                    <h3>{{$u->name}} {{$u->surname}}</h3>
                    <h4 class="gray-custom semi-bold mt-1">Contact</h4>
                    <h6>{{$u->email}}</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="col-8 mt-5">
                <h4 class="gray-custom semi-bold">Biography</h4>
                <p class="gray-custom showMore">{{$u->biography}}</p]>
            </div>
        </div>
    </div>
    <div class="row mt-5 ms-5">
        <div class="col-6 mt-5 align-items-end">
            <div class=" mt-8 ">
                <a href="{{ URL::previous() }}"><button class="btn btn-success col-6">BACK</button></a>
            </div>

        </div>
        <div class="col-md-6 col-12 mt-5 ">
            <h4 class="gray-custom semi-bold">Skills</h4>
            <div class="col-lg-8 col-12 ">
                @foreach($u->skills as $skill)
                <input type="checkbox" class="btn-check" disabled>
                <label class="font-size-skills btn-block m-1 btn btn-outline-success p-4 rounded"">{{$skill->name}}</label>
            @endforeach
           </div>
        </div>
    </div>
    @endforeach
</div>
@endsection


@section('js')
<script src=" {{asset('js/readMoreLess.js')}}">

                    </script>
                    @endsection