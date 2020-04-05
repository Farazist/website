@extends('template')

@section('title')
{{ isset($counter) ? 'ویرایش شمارنده' : 'شمارنده تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($counter) ? 'ویرایش شمارنده' : 'شمارنده تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/counter") }}/{{isset($counter) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">نام</label>
                            <input name="name" id="name" type="text" required autofocus
                                class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                value="{{Request::old('name') ? Request::old('name') : (isset($counter) ? $counter->name : '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="value">مقدار</label>
                            <input name="value" id="value" type="text" required autofocus
                                class="form-control {{$errors->has('value') ? 'is-invalid' : ''}}"
                                value="{{Request::old('value') ? Request::old('value') : (isset($counter) ? $counter->value : '') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">نشانه</label>
                            <input name="icon" id="icon" type="text" required autofocus
                                class="form-control {{$errors->has('icon') ? 'is-invalid' : ''}}"
                                value="{{Request::old('icon') ? Request::old('icon') : (isset($counter) ? $counter->icon : '') }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($counter) ? $counter->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection