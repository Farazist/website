@extends('template')

@section('title')
پرسش های متداول
@endsection

@section('content')

<h2 class="bg-success text-white text-center p-5">
    پرسش های متداول
</h2>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @foreach($faqs as $index => $faq)
                <div class="card mb-2 rounded-lg">
                    <div class="card-header text-success bg-white" id="heading{{ $index }}" data-toggle="collapse"
                        data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}"
                        style="cursor: pointer">
                        {{$faq->question}}
                    </div>
                    <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('includes.contact-us')
@endsection