@extends('template')

@section('title')
{{ isset($item) ? 'ویرایش پسماند' : 'پسماند تازه' }}
@endsection
@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($item) ? 'ویرایش پسماند' : 'پسماند تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form"
                    action="{{ url("/admin/owners/$owner->id/items") }}/{{ isset($item) ? 'edit' : 'add' }}">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>نام</label>
                                    <input name="name" type="text" placeholder="Name" autofocus
                                        class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('name') ? Request::old('name') : (isset($item) ? $item->name : '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>قیمت</label>
                                    <input name="price" type="number" placeholder="Price"
                                        class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('price') ? Request::old('price') : (isset($item) ? $item->price : '0')}}">
                                </div>
                            </div>
                            <input name="id" type="hidden" value="{{ isset($item) ? $item->id : '' }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        </div>
                        <div class="col-md-2">
                            <label>تصویر</label>
                            <div class="form-group">
                                <button type="button" class="btn btn-info btn-block" id="ckf">
                                    انتخاب
                                </button>
                            </div>
                            <input id="img-address" class="form-control" type="hidden" name="image"
                                value="{{Request::old('image') ? Request::old('image') : (isset($item) ? $item->image : '') }}">
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($item) ? URL::asset("$item->image") : '' }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection