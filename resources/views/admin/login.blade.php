@extends('template')

@section('title')
    ورود مدیر
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
    <style>
        body {
            background-color: #1d1d1d;
            font-family: IRANSans !important;
            background-image: url("../images/sign.jpg");
            top: 50px;
            background-position: top;
            background-size: 100%;
            background-repeat: no-repeat;
        }
    </style>
@endsection

@section('content')
    @include('includes.msg')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/login") }}">

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-at fa-fw"></i></div>
                            </div>
                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock fa-fw"></i></div>
                            </div>
                            <input name="password" type="password" class="form-control" placeholder="Password"
                                   required>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input"
                                   id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">
                                مرا به خاطر بسپار
                            </label>
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="recaptcha" id="recaptcha" type="hidden">
                        <button type="submit" class="btn btn-light btn-block rounded-pill">ورود</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
