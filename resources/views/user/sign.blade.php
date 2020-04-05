@extends('layouts.template')

@section('title')
    ثبت نام - ورود
@endsection

@section('url')
    1
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')
    @include('includes.msg')
    <div class="row text-gold">
        <div class="col-lg-8 col-sm-10 signup-form shadow">
            <div class="card bg-transparent border-0 bg-dark h-100">
                <div class="card-body">
                    <h5 class="mb-4 text-center">فرم ثبت نام</h5>
                    <form method="post" action="{{ URL::asset('/signUp') }}" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="first_name">نام</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="First Name" name="first_name" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="last_name">نام خانوادگی</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="email">آدرس ایمیل</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="Email Address" name="email" required>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">جنسیت</label>
                                    <select name="gender"
                                            class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                            id="exampleFormControlSelect1">
                                        <option class="text-dark"> آقا</option>
                                        <option class="text-dark"> خانوم</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">کلمه عبور</label>
                                <input type="password" class="form-control border-gold bg-transparent text-gold"
                                       id="inputPassword4"
                                       placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">تکرار کلمه عبور</label>
                                <input type="password" class="form-control border-gold bg-transparent text-gold"
                                       id="inputPassword4"
                                       placeholder="Password Confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9 col-sm-12">
                                <div class="custom-file">
                                    <label class="custom-file-label text-gold bg-transparent border-gold"
                                           for="customFileLang">عکس پروفایل</label>
                                    <input type="file" class="custom-file-input btn btn-outline-gold" name="image">
                                </div>
                            </div>
                            <div class="form-group mr-auto ml-1">
                                <button type="submit" class="btn btn-outline-gold">تکمیل ثبت نام</button>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-10 signup-form shadow">
            <div class="card bg-transparent border-0 bg-dark h-100">
                <div class="card-body">
                    <h5 class="mb-4 text-center">قبلا ثبت نام کرده اید؟</h5>
                    <form method="post" action="{{ URL::asset('/signIn') }}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">آدرس ایمیل</label>
                                <input type="email" class="form-control border-gold bg-transparent text-gold"
                                       id="inputEmail4"
                                       placeholder="Email Address" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">کلمه عبور</label>
                                <input type="password" class="form-control border-gold bg-transparent text-gold"
                                       id="inputPassword4"
                                       placeholder="Password" name="password" required>
                            </div>
                        </div>
                        <div class="form-row text-left">
                            <div class="col-9 text-right small">
                                <a class="text-decoration-none text-dark-gold" href="#">رمز عبورم را فراموش کردم</a>
                            </div>
                            <div class="form-group col-3 mr-auto">
                                <button type="submit" class="btn btn-outline-gold">ورود</button>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-row text-left">
                            <div class="form-group col-12 text-center text-danger">
                                @if( session('message') )
                                    <p class="text-center text-danger">
                                        {{session('message')}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
