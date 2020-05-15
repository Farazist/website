@extends('template')

@section('title'){{$page->title}}@endsection

@section('description'){{$page->description}}@endsection

@section('keywords'){{$page->keywords}}@endsection

@section('content')

<h2 class="bg-success text-white text-center p-5">
    {{$page->title}}
</h2>
<div class="row pt-2 mb-4 pb-5">
    <div class="col">
        <div class="card bg-white border-0 shadow-sm rounded-lg">
            @if($page->image)
                <img src="{{ URL::asset($page->image) }}" class="card-img-top rounded-lg" alt="{{$page->title}}">
            @endif
            <div class="card-body text-justify">
                {!! $page->body !!}
            </div>
        </div>
    </div>
</div>

@endsection