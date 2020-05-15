@extends('template')

@section('title')
{{ isset($page) ? 'ویرایش برگه' : 'برگه تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0 pt-2">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($page) ? 'ویرایش برگه' : 'برگه تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form"
                    action="{{ URL::asset("/admin/pages") }}/{{ isset($page) ? 'edit' : 'add'}}">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input name="title" type="text" placeholder="Title" required autofocus
                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    value="{{ Request::old('title') ? Request::old('title') : (isset($page) ? $page->title : '') }}">
                            </div>
                            <div class="form-group">
                                <label>متن</label>
                                <textarea name="body" id="editor"
                                      class="form-control">{{Request::old('body') ? Request::old('body') : (isset($page) ? $page->body : '') }}</textarea>
                               
                            </div>
                            <div class="form-group">
                                <label for="description">توصیف</label>
                                <input name="description" type="text" required placeholder="Description"
                                    class="form-control {{$errors->has('description') ? 'is-invalid"' : ''}}"
                                    value="{{Request::old('description') ? Request::old('description') : (isset($page) ? $page->description : '') }}">
                            </div>
                            <div class="form-group">
                                <label for="keywords">کلمات کلیدی</label>
                                <input name="keywords" type="text" required placeholder="Keywords"
                                    class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('keywords') ? Request::old('keywords') : (isset($page) ? $page->keywords : '') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>تصویر</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-block" id="ckf">
                                    انتخاب
                                </button>
                            </div>
                            <input id="img-address" class="form-control" type="hidden" name="image" dir="ltr"
                                value="{{Request::old('image') ? Request::old('image') : (isset($page) ? $page->image : '') }}">

                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($page) ? URL::asset("$page->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($page) ? $page->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection