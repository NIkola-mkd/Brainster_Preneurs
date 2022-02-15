@extends('layouts.master')

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
            <div class="col-6 offset-3">
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
@endsection