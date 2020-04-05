@extends('template')

@section('title'){{$topic->title}}@endsection

@section('description'){{$topic->description}}@endsection

@section('keywords'){{$topic->keywords}}@endsection

@section('content')

    <div class="row">
        <div class="col-md-9 col-12 mb-4">
            <div class="card bg-dark text-white border-0 shadow-sm rounded-lg">
                <img src="{{ URL::asset($topic->image) }}"
                     class="card-img-top rounded-lg" alt="{{$topic->title}}">
                <div class="card-body text-justify">
                    <p class="text-muted">
                        {{$topic->created_date}}
                        <span class="mx-2">|</span>
                        دسته:
                        <a href="{{ URL::asset("/blog/" . $topic->category->name) }}"
                           class="btn btn-link btn-sm text-info">
                            {{ $topic->category->description }}
                        </a>
                    </p>
                    <hr>
                    <h2 class="mb-4">{{$topic->title}}</h2>
                    {!! $topic->body !!}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12 mb-4">
            <div class="list-group shadow-sm mb-4">
                <a href="/blog" class="list-group-item list-group-item-action p-2 bg-info text-light">
                    تازه ترین خبرها
                </a>
                @foreach($new_topics as $new_topic)
                    <a href="{{ URL::asset("/blog/" . $new_topic->category->name . "/" . $new_topic->id) }}"
                       class="list-group-item list-group-item-action p-2 bg-dark text-white">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ URL::asset($new_topic->image) }}" class="img-fluid rounded-lg" alt="{{ $new_topic->title }}">
                            </div>
                            <div class="col-8 pr-0">
                                <h5 class="text-justify">
                                    {{$new_topic->title}}
                                </h5>
                                <p class="small text-secondary">
                                    {{$new_topic->created_date}}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="list-group shadow-sm">
                <a href="/blog" class="list-group-item list-group-item-action p-2 bg-info text-light">
                    دسته بندی ها
                </a>
                @foreach($categories as $category)
                    <a href="{{ URL::asset("/blog/$category->name") }}"
                       class="list-group-item list-group-item-action p-2 bg-dark text-white">
                        {{ $category->description }}
                    </a>
                @endforeach
            </div>
        </div>

    </div>

@endsection
