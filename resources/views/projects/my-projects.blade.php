@extends('layouts.master')

@section('css')
<link href="{{ asset('css/my-projects.css') }}" rel="stylesheet">
@endsection

@section('title','My Projects')

@include('layouts.navbar')

@section('content')
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
<div class="container-fluid">

</div>
@endsection