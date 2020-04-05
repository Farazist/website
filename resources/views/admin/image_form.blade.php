@extends('template')

@section('title')
{{ isset($image) ? 'ویرایش امکانات' : 'امکانات تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($image) ? 'ویرایش امکانات' : 'امکانات تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/image") }}/{{isset($image) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="name">عنوان</label>
                                <input name="title" id="title" type="text" required autofocus
                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('title') ? Request::old('title') : (isset($image) ? $image->title : '') }}">
                            </div>
                            <div class="form-group">
                                <label class="pb-2">
                                    توضیح
                                </label>
                                <textarea name="caption" id="editor"
                                    class="form-control">{{Request::old('caption') ? Request::old('caption') : (isset($image) ? $image->caption : '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>تصویر</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block" id="ckf">
                                    انتخاب
                                </button>
                            </div>
                            <div class="form-group">
                                <input id="img-address" class="form-control" type="hidden" name="image" dir="ltr"
                                    value="{{Request::old('image') ? Request::old('image') : (isset($image) ? $image->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($image) ? URL::asset("$image->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($image) ? $image->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection