@extends('layouts.master')

@section('title','My profile')

@section('css')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@include('layouts.navbar')

@section('content')
<div class="container-fluid">
    <div class="mt-5 mx-5">
        <form action="{{route('profile-update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- profile and skills -->
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h1>My Profile</h1>
                    <div class="row mt-5">
                        <div class="col-lg-6 col-12">
                            <img id="previewAvatar" class="avatar-user img-thumbnail" src="
                            @if($user->image == null) 
                            {{ asset('avatars/default_avatar.png') }}
                            @else
                            {{ asset('avatars/'. $user->image ) }}
                            @endif">
                            <label for="avatar" class="gray-custom mt-lg-1 my-3 upload-image">
                                Click here to upload an image
                            </label>
                            <input id="avatar" type="file" name="image" onchange="previewImage(this);">

                            <div class="row mb-3">
                                @error('image')
                                <span class="red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
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
                    <div class="row mb-3">
                        @error('skills')
                        <span class="red-custom semi-bold mt-1"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 skill-cards mb-5 mb-lg-0">
                            @foreach($skills as $skill)
                            <input type="checkbox" class="btn-check" id="#{{$skill->name}}" autocomplete="off" name="skills[]" value="{{$skill->id}}" {{ in_array($skill->id,$user_skills) ?'checked':'' }}>
                            <label class="font-size-skills  btn-block m-1 btn btn-outline-success p-4 rounded" for="#{{$skill->name}}">{{$skill->name}}</label>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <!-- biography and academies -->
            <div class="row mt-5">
                <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                    <div class="col-12  mt-lg-1 mt-5">
                        <label for="biography" class="classic text-secondary fw-bold fs-4">Biography</label>
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
                            @if($user->academy_id == $academy->id)
                            <input type="radio" class="btn-check" id="#{{$academy->name}}" autocomplete="off" name="academy" value="{{$academy->id}}" checked>
                            @else
                            <input type="radio" class="btn-check" id="#{{$academy->name}}" autocomplete="off" name="academy" value="{{$academy->id}}">
                            @endif
                            <label class="font-size-skills btn-block m-1 btn btn-outline-success p-4 rounded" for="#{{$academy->name}}">{{$academy->name}}</label>
                            @endforeach
                            <div class="row mb-3">
                                @error('academy')
                                <span class="red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
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

    function previewImage(input) {
        let avatar = $("input[type=file]").get(0).files[0];

        if (avatar) {
            let reader = new FileReader();

            reader.onload = function() {
                $("#previewAvatar").attr("src", reader.result);
            }

            reader.readAsDataURL(avatar);
        }
    }
</script>
@endsection