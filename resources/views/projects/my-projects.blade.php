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
<div class="container-fluid">
    <div class="container">
        <div class="col-6">
            <table class="table col-10">
                <thead>
                    <th>
                        Title
                    </th>
                    <th>
                        Descriptuon
                    </th>
                    <th>
                        Academies
                    </th>
                    <th>
                        Author
                    </th>
                    <th>
                        Profession
                    </th>
                    <th>Avatar</th>
                    <th>Applications</th>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>
                            {{$project->title}}
                        </td>
                        <td>
                            {{$project->description}}
                        </td>
                        <td>
                            @foreach($project->academies as $academy)
                            <p>{{$academy->name}}</p>
                            @endforeach
                        </td>
                        @foreach($author as $a)
                        <td>{{$a->name}} {{$a->surname}}</td>
                        <td>{{$a->profession}}</td>
                        <td></td>
                        @endforeach

                        <td>{{$project->users->count()}}</td>

                        @endforeach
            </table>
        </div>
    </div>
</div>
@endsection