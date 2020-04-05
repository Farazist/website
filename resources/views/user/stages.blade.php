@extends('template')

@section('title')
پروفایل
@endsection

{{-- @section('description'){{$exam->description}}@endsection --}}

{{-- @section('keywords'){{$exam->keywords}}@endsection --}}

{{-- @section('image'){{ URL::asset($exam->image) }}@endsection --}}

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 id="exams" class="text-white">
            <img class="img-fluid rounded ml-1" width="32px" src="{{ URL::asset($exam->course->image) }}">
            آزمون
            {{ $exam->course->name }}
        </h3>
        <hr class="bg-info">
        <div class="row mb-4" id="overview">
            @if(Auth::user()->exams->count() == 0)
            <h3 class="card-title">آزمونی وجود ندارد</h3>
            @else
            @foreach($exam->stages as $index => $stage)
            <div class="col-3 mb-4">
                <a href="{{ Auth::user()->exams->find($exam->id)->pivot->stage_number >= $index + 1 ? url("/user/exams/$exam->id/stages/" . ($index + 1)) : '#' }}"
                    class="text-decoration-none">
                    <div class="card shadow-sm rounded-lg h-100 bg-dark text-white border-0 hover">
                        <div class="card-header">
                            {{ $exam->stages->count() }} / {{$index + 1}}
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{$stage->title}}
                            </h4>
                        </div>
                        @if(Auth::user()->exams->find($exam->id)->pivot->stage_number > $index + 1)
                        <div class="card-footer bg-success">
                            <span class="fas fa-check fa-fw ml-2"></span>
                        </div>
                        @elseif(Auth::user()->exams->find($exam->id)->pivot->stage_number == $index + 1)
                        <div class="card-footer bg-primary">
                            <span class="fas fa-play fa-fw ml-2"></span>
                        </div>
                        @elseif(Auth::user()->exams->find($exam->id)->pivot->stage_number < $index + 1) <div
                            class="card-footer">
                            <span class="fas fa-lock fa-fw ml-2"></span>
                    </div>
                    @endif
            </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
@endsection