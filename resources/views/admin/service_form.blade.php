@extends('template')

@section('title')
{{ isset($service) ? 'ویرایش امکانات' : 'امکانات تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($service) ? 'ویرایش امکانات' : 'امکانات تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/service") }}/{{isset($service) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="name">عنوان</label>
                                <input name="title" id="title" type="text" required autofocus
                                    class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('title') ? Request::old('title') : (isset($service) ? $service->title : '') }}">
                            </div>
                            <div class="form-group">
                                <label class="pb-2">
                                    توضیح
                                </label>
                                <textarea name="caption" id="editor"
                                    class="form-control">{{Request::old('caption') ? Request::old('caption') : (isset($service) ? $service->caption : '') }}</textarea>
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
                                    value="{{Request::old('image') ? Request::old('image') : (isset($service) ? $service->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($service) ? URL::asset("$service->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($service) ? $service->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection