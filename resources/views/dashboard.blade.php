@extends('layouts.master')

@section('meta')
<meta name="auth-check" content="{{ Auth::user()->id }}">
<meta name="auth-completed" content="{{ Auth::user()->image }}">
@endsection

@section('css')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('title','Projects')

@include('layouts.navbar')

@section('content')
@if(Auth::user()->image == null)
<!-- alert msg -->
<div class="container-fluid">
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="alert alert-light text-center" role="alert">
                    <h3 class="classic black-custom fw-bolder">Welcome!</h3>
                    <p class="semi-bold black-custom fw-bold"> Please finish up your profile on the following <a href="profile/my-profile" class="alert-link">link</a>, so that you can enjoy all our features.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- end alert msg -->

<!-- projects -->
<div class="container-fluid mt-5">
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 ms-5">
                    <h5 class="semi-bold-bolder my-4">In what field can you been amazing?</h5>
                    <form action="" id="category">
                        <div class="col-2 filter">
                            <input type="radio" class="btn-check category" id="all" autocomplete="off" name="academies" value="all">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success rounded text-wrap filter-width" for="all">All</label>
                            @foreach($academies as $academy)
                            <input type="radio" class="btn-check category" id="#{{$academy->name}}" autocomplete="off" name="academies" value="{{$academy->id}}">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success text-wrap filter-width rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="col-7" id="projectsCards">
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-6 offset-6">
                                <div class="col-12" id="pagination">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script src="{{asset('js/ajax.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"> </script>
@endsection