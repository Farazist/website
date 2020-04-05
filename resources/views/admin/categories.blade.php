@extends('admin.admin-template')

@section('title')
    دوره ها
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark pb-4 rounded-lg" style="box-shadow: 5px 5px 15px black">
        <div class="row p-3 text-center">
            <div class="col-12 text-light px-0">
                <h4 class="text-gold d-inline-block border-gold border-left border-right px-3">دسته بندی ها</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form method="post" action="/admin/add_category">
                    <div class="form-group">
                        <input name="category" type="text" placeholder="نام دسته بندی" class="form-control bg-transparent text-gold border-gold p-2 mt-2">
                    </div>
                    <button type="submit" class="btn btn-outline-gold offset-5">افزودن</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
            <div class="col-6">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item bg-transparent border-bottom text-gold">{{ $category->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
