@extends('admin.admin-template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    @include('includes.msg')
    <div class="row text-light">
        <div class="col-sm-7 offset-lg-1 signup-form border border-light rounded">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <form method="post" action="/admin/addAdmin" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">آدرس ایمیل</label>
                                <input type="email" class="form-control bg-transparent" id="inputEmail4"
                                       placeholder="Email Address" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">کلمه عبور</label>
                                <input type="password" class="form-control bg-transparent" id="inputPassword4"
                                       placeholder="Password" name="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">تکرار کلمه عبور</label>
                                <input type="password" class="form-control bg-transparent" id="inputPassword4"
                                       placeholder="Password Confirmation" name="password_confirmation">
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">تکمیل ثبت نام</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
