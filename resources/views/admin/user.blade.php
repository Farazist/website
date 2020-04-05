@extends('admin.admin-template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark py-4 rounded-lg" style="box-shadow: 5px 5px 15px black">
        <div class="row">
            <form class="w-100" method="post" action="/signUp" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="text-gold" for="inputEmail4">آدرس ایمیل</label>
                        <input type="email" class="form-control bg-transparent text-gold border-gold" id="inputEmail4"
                               placeholder="Email Address" name="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group col-2">
                        <label class="text-gold" for="inputEmail4">نام</label>
                        <input type="text" class="form-control bg-transparent text-gold border-gold" id="inputEmail4"
                               placeholder="First Name" name="first_name" value="{{ $user->first_name }}" readonly>
                    </div>
                    <div class="form-group col-2">
                        <label class="text-gold" for="inputEmail4">نام خانوادگی</label>
                        <input type="text" class="form-control bg-transparent text-gold border-gold" id="inputEmail4"
                               placeholder="Last Name" name="last_name" value="{{ $user->last_name }}" readonly>
                    </div>
                    <div class="form-group col-2">
                        <label class="text-gold" for="inputPassword4">کلمه عبور</label>
                        <input type="password" class="form-control bg-transparent text-gold border-gold" id="inputPassword4"
                               placeholder="Password" name="password" value="{{ $user->password }}" readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-2 mx-auto">
                <div class="card" style="width: 10rem;">
                    <img src="/images/avatars/{{ $user->id }}.jpg" class="card-img-top" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
