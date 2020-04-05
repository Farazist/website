@extends('template')

@section('title')
    وبلاگ
@endsection
@section('content')

    <h2 class="font-weight-bold text-info text-center mt-1 mb-3">
        بلاگ
    </h2>
    {{-- <p class="text-center my-3">
        اخبار مجتمع بین الملل را در اینجا بخوانید
    </p> --}}
    <div class="row">
        <div class="col-md-9 col-12 px-0">
            <div class="row">
                @foreach($topics as $topic)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <a href="{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}"
                           class="text-white text-decoration-none">
                            <div class="card shadow-sm border-0 rounded text-justify h-100 bg-dark hover">
                                <img src="{{ URL::asset("$topic->image") }}" class="card-img-top"
                                     alt="{{$topic->title}}">
                                <div class="card-body px-3 pt-3 pb-0">
                                    <p class="small text-secondary">
                                        {{$topic->created_date}}
                                    </p>
                                    <h4 class="card-title text-justify">
                                        {{$topic->title}}
                                    </h4>
                                    <p class="card-text text-justify small">
                                        {!! $topic->body !!}
                                    </p>
                                </div>
                                <div class="card-footer border-0 bg-transparent px-3 pb-3 pt-0">
                                    <i class="fas fa-arrow-left fa-pull-left text-info"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $topics->links("pagination::bootstrap-4") }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12 mb-4">
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
