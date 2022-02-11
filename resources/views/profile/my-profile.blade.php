@extends('layouts.master')

@section('title','My profile')

@section('css')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@include('layouts.navbar')

@section('content')
<div class="container-fluid">
    <div class="mt-5 mx-5">
        <form action="" method="POST">
            <!-- profile and skills -->
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h1>My Profile</h1>
                    <div class="row mt-5">
                        <div class="col-lg-6 col-12">
                            @if($user->image == null)
                            <img class="avatar-user img-thumbnail" src="{{ asset('avatars/default_avatar.png') }}">
                            <figcaption class="gray-custom my-2">Click here to upload an image</figcaption>
                            @endif
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                </div>
                                <div class="row mb-3">
                                    @error('name')
                                    <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
                                </div>
                                <div class="row mb-3">
                                    @error('surname')
                                    <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                </div>
                                <div class="row mb-3">
                                    @error('email')
                                    <span class="red-custom semi-bold mt-1"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12 offset-lg-1">
                    <h1>Skills</h1>
                    <div class="row mt-5">
                        <div class="col-12 skill-cards h-50 d-inline-block">
                            @foreach($skills as $skill)
                            <input type="checkbox" class="btn-check" id="#{{$skill->name}}" autocomplete="off" name="skills[{{$skill->id}}]">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success p-4 rounded" for="#{{$skill->name}}">{{$skill->name}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- biography and academies -->
            <div class="row mt-5">
                <div class="col-lg-4 col-12">
                    <div class="col-12  mt-1">
                        <label for="biogrephy" class="classic text-secondary fw-bold fs-4">Biography</label>
                        <textarea class="form-control my-3" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt quis ante sed tempus. Cras imperdiet, quam ac fringilla venenatis, lectus nisl sagittis quam, eget tincidunt velit nibh at dui. Sed vel libero feugiat, luctus lacus at, fringilla sem. Nam tincidunt tortor velit, in porta dolor ullamcorper quis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. 

" id="biography" name="biography">{{$user->biography}}</textarea>
                        <div class="row mb-3">
                            @error('biography')
                            <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1 col-12">
                    <h1>Academies</h1>
                    <div class="col-12 mt-2">
                        <div class="col-10">
                            @foreach($academies as $academy)
                            <input type="radio" class="btn-check" id="#{{$academy->name}}" autocomplete="off" name="academy" value="{{$academy->id}}">
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success p-4 rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <!-- submit button -->
            <div class="row">
                <div class="mt-1">
                    <div class="col-2 ms-md-auto d-grid gap-2">
                        <button type="submit" class="btn btn-lg bg-green-custom text-white px-4 round">EDIT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $("textarea").each(function() {
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }).on("input", function() {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });
</script>
@endsection