@extends('template')

@section('title')
پروفایل
@endsection

{{-- @section('description'){{$course->description}}@endsection --}}

{{-- @section('keywords'){{$course->keywords}}@endsection --}}

{{-- @section('image'){{ URL::asset($course->image) }}@endsection --}}

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow rounded-lg border-0 bg-dark text-white">
            <div class="card-header">
                {{ $lesson->stage->title }}
            </div>
            <div class="card-body text-justify position-relative">

                {!! $lesson->text !!}
                <hr>
                <a href="{{ url("/user/exams/$exam->id/stages/$stage_number/question") }}" class="btn btn-info">
                    بعدی
                </a>
            </div>
            
        </div>
    </div>

</div>
@endsection