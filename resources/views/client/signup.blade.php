@extends('template')

@section('title')
ثبت نام
@endsection

@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')
<div class="row pb-4">
    <div class="col-lg-6 mb-4">
        <div class="card border-0 bg-dark text-white shadow">
            <div class="card-header">
                <h3 class="text-center text-info my-0">
                    نام نویسی
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset('/sign-up') }}" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>نام</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label> ایمیل</label>
                            <input type="text" class="form-control" placeholder="Email Address" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>کلمه عبور</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>تصویر پروفایل</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFileLang"></label>
                                <input type="file" class="custom-file-input btn" name="image">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-info"> ثبت نام</button>
                </form>
            </div>
            <div class="card-footer">
                <div class="form-row mb-0">
                    <div class="form-group col-md-6 mb-md-0">

                        <a href="{{ url('auth/google') }}" class="btn btn-white btn-block rounded-lg">
                            <img src="{{ url('images/logo/google.svg') }}" class="img-fluid ml-1" style="height: 20px">
                            ورود با حساب گوگل
                        </a>
                    </div>
                    <div class="form-group col-md-6 mb-md-0">

                        <script async src="https://telegram.org/js/telegram-widget.js?7"
                            data-telegram-login="i3center_login_bot" data-size="large" data-radius="5"
                            data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                        <script type="text/javascript">
                            function onTelegramAuth(user) {
                                alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (
                                    user
                                    .username ? ', @' + user.username : '') + ')');
                            }
                        </script>
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </div>
        </div>
    </div>

    <div class="col-lg-6 text-center">
        <img src="{{ url('/images/sign-up.svg') }}" class="img-fluid w-75">
    </div>
</div>

@endsection