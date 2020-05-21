@extends('template')

@section('title')
{{ isset($citizen) ? 'ویرایش شهروند' : 'شهروند تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($citizen) ? 'ویرایش شهروند' : 'شهروند تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/citizens") }}/{{isset($citizen) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="id">شناسه</label>
                                    <input name="id" id="id" type="text" readonly class="form-control"
                                        value="{{Request::old('id') ? Request::old('id') : (isset($citizen) ? $citizen->id : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">نام</label>
                                    <input name="name" id="name" type="text" required autofocus
                                        class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('name') ? Request::old('name') : (isset($citizen) ? $citizen->name : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mobile_number">شماره همراه</label>
                                    <input name="mobile_number" id="mobile_number" type="text" readonly
                                        class="form-control {{$errors->has('mobile_number') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('mobile_number') ? Request::old('mobile_number') : (isset($citizen) ? $citizen->mobile_number : '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">استان</label>
                                    <select class="form-control">
                                        <option value="-1"> </option>
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}" {{ (isset($citizen) && isset($citizen->city) && $citizen->city->province_id == $province->id ? 'selected' : '') }}>
                                                {{$province->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">شهر</label>
                                    <select class="form-control" name="city_id">
                                        <option value="-1"> </option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{Request::old('city_id') && Request::old('city_id') == $city->id ? 'selected' : (isset($citizen) && $citizen->city_id == $city->id ? 'selected' : '') }}>
                                                {{$city->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="address">آدرس</label>
                                    <input name="address" id="address" type="text" autofocus
                                        class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('address') ? Request::old('address') : (isset($citizen) ? $citizen->address : '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="d-block">نوع حساب</label>
                                    <div class="btn-group btn-group-toggle special" data-toggle="buttons">
                                        <label class="btn btn-success {{isset($citizen) ? ($citizen->role == 2 ? 'active' : '') : 'active' }}">
                                            <input type="radio" name="role" value="2" id="option1"
                                                   autocomplete="off" {{isset($citizen) ? ($citizen->role == 2 ? 'checked' : '') : 'checked' }}>
                                            مالک
                                        </label>
                                        <label class="btn btn-success {{isset($citizen) && $citizen->role == 3 ? 'active' : ''}}">
                                            <input type="radio" name="role" value="3" id="option2"
                                                   autocomplete="off" {{isset($citizen) && $citizen->role == 3 ? 'checked' : ''}}>
                                            شهروند
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">دستگاه متصل</label>
                                    <select class="form-control" name="system_id">
                                        <option value="-1"> </option>
                                        @foreach($systems as $system)
                                            <option value="{{$system->id}}" {{Request::old('system_id') && Request::old('system_id') == $system->id ? 'selected' : (isset($citizen) && $citizen->system_id == $system->id ? 'selected' : '') }}>
                                                {{$system->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="wallet">کیف پول</label>
                                    <input name="wallet" id="wallet" type="text" 
                                        class="form-control {{$errors->has('wallet') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('wallet') ? Request::old('wallet') : (isset($citizen) ? $citizen->wallet : '') }}">
                                </div>
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
                                    value="{{Request::old('image') ? Request::old('image') : (isset($citizen) ? $citizen->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($citizen) ? url("$citizen->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($citizen) ? $citizen->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection