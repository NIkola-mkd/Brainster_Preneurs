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
                    <div class="form-div bg-dark">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio natus excepturi libero accusamus iste odit error unde quidem ipsam magnam tempore ratione neque deserunt atque distinctio, architecto fugiat in hic.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection