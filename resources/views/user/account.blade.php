@extends('client.template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
    <style>
        body {
            background-image: url("../images/sign.jpg");
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #1d2124;
        }
    </style>
@endsection

@section('content')
    @include('includes.msg')
    <div class="row text-gold mx-auto" style="margin-top: 130px;">
        <div class="col-8 bg-dark offset-lg-2 signup-form shadow">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="mb-4 text-center">فرم ثبت نام</h5>
                    <form method="post" action="{{ URL::asset('/user/account_edited') }}" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="first_name">نام</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="First Name" name="first_name" required
                                       value="{{$user->first_name}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="last_name">نام خانوادگی</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="Last Name" name="last_name" required value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="email">آدرس ایمیل</label>
                                <input type="text" class="form-control bg-transparent border-gold text-gold"
                                       placeholder="Email Address" name="email" required value="{{$user->email}}">
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
                                <label for="inputPassword4">کلمه عبور جدید</label>
                                <input type="password" class="form-control border-gold bg-transparent text-gold"
                                       id="inputPassword4"
                                       placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"> تکرار کلمه عبور جدید</label>
                                <input type="password" class="form-control border-gold bg-transparent text-gold"
                                       id="inputPassword4"
                                       placeholder="Password Confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-9">
                                <div class="custom-file">
                                    <label class="custom-file-label text-gold bg-transparent border-gold"
                                           for="customFileLang">عکس پروفایل</label>
                                    <input type="file" class="custom-file-input btn btn-outline-gold" name="image">
                                </div>
                            </div>
                            <div class="form-group mr-auto ml-1">
                                <button type="submit" class="btn btn-outline-gold">ثبت تغییرات</button>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
