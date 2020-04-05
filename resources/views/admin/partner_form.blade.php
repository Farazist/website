@extends('template')

@section('title')
{{ isset($partner) ? 'ویرایش همکار' : 'همکار تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($partner) ? 'ویرایش همکار' : 'همکار تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/partner") }}/{{isset($partner) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="name">عنوان</label>
                                <input name="name" id="title" type="text" required autofocus
                                    class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('name') ? Request::old('name') : (isset($partner) ? $partner->name : '') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">لینک</label>
                                <input name="url" id="title" type="text" required autofocus
                                    class="form-control {{$errors->has('url') ? 'is-invalid' : ''}}"
                                    value="{{Request::old('url') ? Request::old('url') : (isset($partner) ? $partner->url : '') }}">
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
                                    value="{{Request::old('image') ? Request::old('image') : (isset($partner) ? $partner->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($partner) ? url("$partner->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($partner) ? $partner->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection