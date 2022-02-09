@extends('layouts.master')

@section('css')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid my-5">
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-6">
                <div class="row">
                    <div class="left-panel">
                        <h1> <span class="black-custom semi-bold">Brainster</span><span class="gray-custom semi-bold">Preneurs</span> </h1>
                        <h2 class="classic my-5">Propel your ideas to life!</h2>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="form-div ">
                        <h3 class="semi-bold ">Login</h3>
                        <div class="row">
                            <div class="col-10">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
                                    </div>
                                    <div class="row mb-3">
                                        @error('email')
                                        <span class=" red-custom semi-bold my-1"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="row mb-3">
                                        @error('password')
                                        <span class="red-custom semi-bold my-1"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-10 offset-6">
                                        <button type="submit" class="btn px-5 bg-orange-custom text-white">Login</button>
                                    </div>
                                </form>
                                <p class="my-5 classic">Don't have an account, register <a class="link-secondary" href="/register">here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection