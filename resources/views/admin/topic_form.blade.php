@extends('template')

@section('title')
{{ isset($topic) ? 'ویرایش پست' : 'پست تازه' }}
@endsection

@section('content')

<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($topic) ? 'ویرایش پست' : 'پست تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form"
                    action="{{ URL::asset("/admin/blog") }}/{{ isset($topic) ? 'edit' : 'add'}}">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="text-white">عنوان</label>
                                <input name="title" type="text" placeholder="Title" required autofocus
                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    value="{{ Request::old('title') ? Request::old('title') : (isset($topic) ? $topic->title : '') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-white">متن</label>
                                <textarea name="body" id="editor"
                                    class="form-control">{{Request::old('body') ? Request::old('body') : (isset($topic) ? $topic->body : '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="text-white">توصیف</label>
                                <input name="description" type="text" required placeholder="Description"
                                    class="form-control {{$errors->has('description') ? 'is-invalid"' : ''}}"
                                    value="{{Request::old('description') ? Request::old('description') : (isset($topic) ? $topic->description : '') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-white">کلمات کلیدی</label>
                                <input name="keywords" type="text" required placeholder="Keywords"
                                    class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('keywords') ? Request::old('keywords') : (isset($topic) ? $topic->keywords : '') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="text-white">تصویر</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-block" id="ckf">
                                    انتخاب
                                </button>
                            </div>
                            <input id="img-address" class="form-control" type="hidden" name="image" dir="ltr"
                                value="{{Request::old('image') ? Request::old('image') : (isset($topic) ? $topic->image : '') }}">

                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($topic) ? URL::asset("$topic->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($topic) ? $topic->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection