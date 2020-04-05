@extends('template')

@section('title')
    LMS - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')

        <div class="row">
            <div class="col-12 mt-5 pt-2">
                <div class="row mb-4">
                    <div class="col-5 border-left border-gold">
                        <h2 class="text-light">دوره {{$course->title}}</h2>
                        <h5 class="text-gold my-3">مدرس
                            دوره: {{$course->teacher->first_name}} {{$course->teacher->last_name}}</h5>
                        <h6 class="text-gold mb-3">سطح دوره: {{ $course->level->name }}</h6>
                    </div>
                    @if($price > 0)
                        <div class="col-4 offset-3 border-left border-gold">
                            <h6 class="text-light">مجموع قیمت ویدئوها: {{ $price }} تومان</h6>
                            <h4 class="text-gold my-3">قیمت با تخفیف: {{ $price*0.8 }} تومان</h4>
                            <a href="{{ URL::asset('#') }}" class="btn btn-outline-gold text-center">ادامه برای خرید</a>
                        </div>
                    @endif
                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-light active" id="pills-home-tab" data-toggle="pill" href="{{ URL::asset('#pills-home') }}"
                           role="tab" aria-controls="pills-home" aria-selected="true">اطلاعات دوره</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" id="pills-profile-tab" data-toggle="pill" href="{{ URL::asset('#pills-profile') }}"
                           role="tab" aria-controls="pills-profile" aria-selected="false">سرفصل ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" id="pills-contact-tab" data-toggle="pill" href="{{ URL::asset('#pills-contact') }}"
                           role="tab" aria-controls="pills-contact" aria-selected="false">درباره استاد</a>
                    </li>
                </ul>
                <div class="tab-content border-0" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="card text-center bg-transparent border-0 text-light">
                            <div class="card-body p-0 text-right p-2">
                                <p class="card-text m-0 border-left border-light">{!! $course->announcement !!} <p
                                        class="text-secondary">{{$course->created_at}}</p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane text-light fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <p class="text-light">{!! $course->headlines !!}</p>
                    </div>
                    <div class="tab-pane fade text-light" id="pills-contact" role="tabpanel"
                         aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-1"><img src="{{ URL::asset($course->teacher->avatar_address) }}" class="img-fluid rounded-circle" alt="Responsive image" style="width: 100px;"></div>
                            <div class="col-9">
                                <h3>{{ $course->teacher->first_name }} {{ $course->teacher->last_name }}</h3>
                                {!! $course->teacher->about !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-gold border-left border-right border-gold m-5">ویدئوها</h1>
            </div>
        </div>
        <div class="row">
            @foreach($videos as $i => $video)
                <div class="col-10 offset-1 p-4 my-3 text-center">
                    <h3 class="text-gold">ویدئوی شماره {{$i+1}}: {{$video->title}}</h3>
                    @if($video->price == 0)
                        <div class="col-10 offset-1 py-3 embed-responsive embed-responsive-16by9">
                            <video src="{{ $video->video_address }}" controls></video>
                        </div>
                    @else
                        <div class="text-gold col-10 offset-1 py-3">
                            <p>هزینه این ویدئو: {{ $video->price }} تومان</p>
                            <a href="{{ URL::asset('#') }}" class="btn btn-outline-gold">ادامه برای خرید این ویدئو</a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

@endsection
