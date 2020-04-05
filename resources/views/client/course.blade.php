@extends('template')

@section('title'){{$course->name}}@endsection

@section('description'){{$course->description}}@endsection

@section('keywords'){{$course->keywords}}@endsection

@section('image'){{ URL::asset($course->image) }}@endsection

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="row" style="position: sticky !important; top: 80px;">
            <div class="col-12 p-0">
                <div class="row mb-4">
                    <div class="col-12 p-0">
                        <div class="card shadow-sm rounded-lg text-center h-100 bg-dark text-white border-0 ">
                            <div class="card-body">
                                <img src="{{ URL::asset($course->image) }}" class="card-img-top w-50"
                                    alt="{{$course->name}}">
                            </div>
                            <div class="card-footer">
                                <h4 class="card-title">
                                    {{$course->name_fa}}
                                </h4>
                                <p class="card-text text-wrap small">
                                    {{ $course->short_explanation }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-4 p-0">
                        <div class="list-group">
                            <a href="#overview" class="list-group-item bg-dark text-white">
                                مروری بر دوره
                            </a>
                            <a href="#headlines" class="list-group-item bg-dark text-white">
                                سرفصل ها
                            </a>
                            <a href="#prerequisites" class="list-group-item bg-dark text-white">
                                پیش نیازها
                            </a>
                            <a href="{{ url("/user/course/$course->id/add-to-basket") }}" class="list-group-item bg-info text-white">
                                افزودن به سبد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="row mb-4" id="overview">
            <div class="col-12 px-0">
                <div class="card shadow-sm bg-dark rounded border-0">
                    <div class="card-header text-info h5 bg-transparent">
                        مروری بر دوره
                    </div>
                    <div class="card-body text-white">
                        <div class="text-justify">
                            {!! $course->explanation !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" id="headlines">
            <div class="col-12 px-0">
                <div class="card shadow-sm bg-dark rounded border-0">
                    <div class="card-header text-info h5 bg-transparent">
                        سرفصل ها
                    </div>
                    <div class="card-body text-white">
                        <div class="text-justify">
                            {!! $course->headlines !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" id="prerequisites">
            <div class="col-12 px-0">
                <div class="card shadow-sm bg-dark rounded border-0">
                    <div class="card-header text-info h5 bg-transparent">
                        پیش نیازها
                    </div>
                    <div class="card-body">
                        <div class="text-justify">
                            {!! $course->prerequisites !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4" id="calendar">
            <div class="col-12 px-0">
                <div class="card shadow-sm bg-dark rounded border-0">
                    <div class="card-header text-info h5 bg-transparent border-0">
                        تقویم آموزشی
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection