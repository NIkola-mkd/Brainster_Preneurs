@extends('layouts.master')

@section('title','Register')

@section('css')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="my-5 semi-bold black-custom">Register</h1>
        <div class="row my-4">
            <div class="col-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                            </div>
                            <div class="row mb-3">
                                @error('name')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surame" value="{{old('surname')}}">
                            </div>
                            <div class="row mb-3">
                                @error('surname')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                            </div>
                            <div class="row mb-3">
                                @error('email')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{old('password')}}">
                            </div>
                            <div class="row mb-3">
                                @error('password')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12  mt-1">
                            <label for="biogrephy" class="classic text-secondary ">Biography</label>
                            <textarea class="form-control my-3" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt quis ante sed tempus. Cras imperdiet, quam ac fringilla venenatis, lectus nisl sagittis quam, eget tincidunt velit nibh at dui. Sed vel libero feugiat, luctus lacus at, fringilla sem. Nam tincidunt tortor velit, in porta dolor ullamcorper quis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. 

" id="biography" name="biography">{{old('biography')}}</textarea>
                            <div class="row mb-3">
                                @error('biography')
                                <span class=" red-custom semi-bold mt-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="d-grid gap-2 col-6 ">
                            <button type="submit" class="btn btn-lg bg-green-custom text-white">Register</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/textarea.js') }}"></script>
@endsection