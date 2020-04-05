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
                پرسش شماره 
                {{ Session::get('question_number') }}
                از 
                {{ $stage->questions->count() }}
            </div>
            <div class="card-body text-justify position-relative">

                {!! $question->text !!}

                <form method="POST" action="{{ url("user/exams/$exam->id/stages/$stage_number/question") }}">
                    @foreach ($question->answers as $i => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="Radio{{ $i }}" name="answer" class="custom-control-input"
                            value="{{ $answer->id }}">
                        <label class="custom-control-label text-white" for="Radio{{ $i }}">
                            {!! $answer->text !!}
                        </label>
                    </div>
                    @endforeach
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-info">بعدی</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection