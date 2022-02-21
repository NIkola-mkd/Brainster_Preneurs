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
                <div class="col-12 menu-responsive">
                    <h5 class="semi-bold-bolder my-4 ">In what field can you been amazing?</h5>
                    <div class="btn-group dropend ">
                        <button type="button" class="btn btn-secondary ">
                            Select Field
                        </button>
                        <button type="button" class="btn  btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropright</span>
                        </button>
                        <ul class="dropdown-menu">
                            <div class="col-12">
                                <input type="radio" class="btn-check category" id="all" autocomplete="off" name="academies" value="all">
                                <label class="col-12 btn-block m-1 btn btn-outline-success rounded text-wrap " for="all">All</label>
                                @foreach($academies as $academy)
                                <input type="radio" class="btn-check category" id="#{{$academy->name}}" autocomplete="off" name="academies" value="{{$academy->id}}">
                                <label class="col-12 btn-block m-1 btn btn-outline-success text-wrap rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-4 ms-5 wrapper menu">
                    <form action="" id="category">
                        <div class="col-lg-2 col-4 fixed filters">
                            <input type="radio" class="btn-check category" id="all" autocomplete="off" name="academies" value="all">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success rounded text-wrap filter-width" for="all">All</label>
                            @foreach($academies as $academy)
                            <input type="radio" class="btn-check category" id="#{{$academy->name}}" autocomplete="off" name="academies" value="{{$academy->id}}">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success text-wrap filter-width rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 col-10 offset-lg-0 offset-1" id="projectsCards">
                    <h5 class="semi-bold-bolder my-4 text-end ">
                        <img class="icon mt-5" src="{{asset('custom_icons/3.png')}}" alt="">
                        Checkout for the latest projects
                    </h5>

                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-5 col-md-8  offset-md-3 col-12">
                                <div class="col-12 " id="pagination">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Apply for this project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input name="project_id" id="projectID" hidden>
                <div class="col-12  mt-lg-1">
                    <label for="message" class="classic text-secondary fw-bold ">Message</label>
                    <textarea class="form-control my-3" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt quis ante sed tempus. Cras imperdiet, quam ac fringilla venenatis, lectus nisl sagittis quam, eget tincidunt velit nibh at dui. Sed vel libero feugiat, luctus lacus at, fringilla sem. Nam tincidunt tortor velit, in porta dolor ullamcorper quis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. " id="message" name="message"></textarea>
                    <div class="row mb-3">
                        <span class=" red-custom semi-bold mt-1" id="error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success send">Apply</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{asset('js/ajax.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"> </script>
<script src="{{ asset('js/textarea.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection