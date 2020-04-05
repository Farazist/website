@extends('layouts.template')

@section('title')
    LMS - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')
    @include('includes.user-header')
    <div class="container mt-1">
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <h2 class="text-gold text-center">لیست دوره های Iranian College</h2>
            </div>
        </div>
        <div class="row mt-5">
            @if(isset($search_item))
                <div class="col-12">
                    <div class="alert text-dark alert-light" role="alert">
                        شما برای {{$search_item}} جستجو کردید
                    </div>
                </div>
            @endif
            @foreach($courses as $course)
                <div class="col-3 mb-4" style="height: 28rem;">
                    <div class="card h-100 bg-dark border-0 shadow text-light rounded-lg" id="course-card">
                        <img src="{{ URL::asset($course->avatar_address) }}" class="card-img-top" alt="..."
                             style="height: 9rem;">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title text-center">{{ $course->title }}</h4>
                            <p class="card-text">{!! Str::limit($course->announcement, 100);  !!}</p>
                            <a href="{{ URl::asset(str_replace(' ' , '-' , '/user/course/' . $course->title)) }}"
                               class="btn text-gold float-left mt-auto stretched-link">ادامه
                                مطلب</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($courses) == 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <h3 class="text-gold text-center">متاسفانه موردی یافت نشد!</h3>
                    </div>
                </div>
            @endif
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="row no-gutters bg-dark shadow-lg text-gold position-relative" id="course-card">
                    <div class="col-md-6 mb-md-0 p-md-4">
                        <img src="{{ URL::asset('/images/40.jpg') }}" class="w-100" alt="...">
                    </div>
                    <div class="col-md-6 position-static p-4 pl-md-0">
                        <h5 class="mt-0">تخفیف ویژه Iranian College</h5>
                        <p>با ثبت نام تمام دوره های ما بصورت یک جا از 40% تخفیف در پرداخت بهره مند شوید! دوره های متنوع
                            طراحی سایت از پایه HTML تا تخصص در Laravel
                            <br> یک سرمایه گذاری مطمئن!
                        <ul>
                            <li>HTML</li>
                            <li>CSS</li>
                            <li>Java Script</li>
                            <li>Bootstrap</li>
                            <li>PHP</li>
                            <li>Laravel</li>
                            <li>SEO</li>
                        </ul>
                        </p>
                        <a href="{{ URL::asset('#') }}" class="text-gold text-decoration-none stretched-link">ادامه مطلب</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        @include('includes.big-courses')
    </div>
    <br>
    <br>
    @include('includes.footer')
@endsection
