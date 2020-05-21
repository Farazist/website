@extends('template')

@section('title')
{{ isset($system) ? 'ویرایش دستگاه' : 'دستگاه تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($system) ? 'ویرایش دستگاه' : 'دستگاه تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/systems") }}/{{isset($system) ? 'edit' : 'add'}}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="id">شناسه</label>
                                    <input name="id" id="id" type="text" {{isset($system) ? 'readonly' : ''}}
                                        class="form-control {{$errors->has('id') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('id') ? Request::old('id') : (isset($system) ? $system->id : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">نام</label>
                                    <input name="name" id="name" type="text" required autofocus
                                        class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('name') ? Request::old('name') : (isset($system) ? $system->name : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">مالک</label>
                                    <select class="form-control" name="owner_id">
                                        <option value="-1"> </option>
                                        @foreach($owners as $owner)
                                        <option value="{{$owner->id}}"
                                            {{Request::old('owner_id') && Request::old('owner_id') == $owner->id ? 'selected' : (isset($system) && $system->owner_id == $owner->id ? 'selected' : '') }}>
                                            {{$owner->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">استان</label>
                                    <select class="form-control">
                                        <option value="-1"> </option>
                                        @foreach($provinces as $province)
                                        <option value="{{$province->id}}"
                                            {{ (isset($system) && isset($system->city) && $system->city->province_id == $province->id ? 'selected' : '') }}>
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
                                        <option value="{{$city->id}}"
                                            {{Request::old('city_id') && Request::old('city_id') == $city->id ? 'selected' : (isset($system) && $system->city_id == $city->id ? 'selected' : '') }}>
                                            {{$city->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="address">آدرس</label>
                                    <input name="address" id="address" type="text" autofocus
                                        class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('address') ? Request::old('address') : (isset($system) ? $system->address : '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="lat">طول جغرافیایی</label>
                                    <input name="lat" id="lat" type="text" required autofocus
                                        class="form-control {{$errors->has('lat') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('lat') ? Request::old('lat') : (isset($system) ? $system->lat : '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lng">عرض جغرافیایی</label>
                                    <input name="lng" id="lng" type="text" required autofocus
                                        class="form-control {{$errors->has('lng') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('lng') ? Request::old('lng') : (isset($system) ? $system->lng : '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">زمان فعالیت</label>
                                    <div class="btn-group btn-group-toggle special" data-toggle="buttons">
                                        <label
                                            class="btn btn-success {{isset($system) ? ($system->activation_type == 'auto' ? 'active' : '') : 'active' }}">
                                            <input type="radio" name="activation_type" value="auto" id="option1"
                                                autocomplete="off"
                                                {{isset($system) ? ($system->activation_type == 'auto' ? 'checked' : '') : 'checked' }}>
                                            خودکار
                                        </label>
                                        <label
                                            class="btn btn-success {{isset($system) && $system->activation_type == 'manual' ? 'active' : ''}}">
                                            <input type="radio" name="activation_type" value="manual" id="option2"
                                                autocomplete="off"
                                                {{isset($system) && $system->activation_type == 'manual' ? 'checked' : ''}}>
                                            دستی
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">وضعیت</label>
                                    <div class="btn-group btn-group-toggle special" data-toggle="buttons">
                                        <label
                                            class="btn btn-success {{isset($system) ? ($system->state == 'active' ? 'active' : '') : 'active' }}">
                                            <input type="radio" name="state" value="active" id="option1"
                                                autocomplete="off"
                                                {{isset($system) ? ($system->state == 'active' ? 'checked' : '') : 'checked' }}>
                                            فعال
                                        </label>
                                        <label
                                            class="btn btn-success {{isset($system) && $system->state == 'deactive' ? 'active' : ''}}">
                                            <input type="radio" name="state" value="deactive" id="option2"
                                                autocomplete="off"
                                                {{isset($system) && $system->state == 'deactive' ? 'checked' : ''}}>
                                            غیر فعال
                                        </label>
                                        <label
                                            class="btn btn-success {{isset($system) && $system->state == 'block' ? 'active' : ''}}">
                                            <input type="radio" name="state" value="block" id="option2"
                                                autocomplete="off"
                                                {{isset($system) && $system->state == 'block' ? 'checked' : ''}}>
                                            مسدود
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="morning_start_time">زمان آغاز شیفت صبح</label>
                                    <input name="morning_start_time" id="morning_start_time" type="text"
                                        class="form-control {{$errors->has('morning_start_time') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('morning_start_time') ? Request::old('morning_start_time') : (isset($system) ? $system->morning_start_time : '') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="morning_end_time">زمان پایان شیفت صبح</label>
                                    <input name="morning_end_time" id="morning_end_time" type="text"
                                        class="form-control {{$errors->has('morning_end_time') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('morning_end_time') ? Request::old('morning_end_time') : (isset($system) ? $system->morning_end_time : '') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="afternoon_start_time">زمان آغاز شیفت عصر</label>
                                    <input name="afternoon_start_time" id="afternoon_start_time" type="text"
                                        class="form-control {{$errors->has('afternoon_start_time') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('afternoon_start_time') ? Request::old('afternoon_start_time') : (isset($system) ? $system->afternoon_start_time : '') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="afternoon_end_time">زمان پایان شیفت عصر</label>
                                    <input name="afternoon_end_time" id="afternoon_end_time" type="text"
                                        class="form-control {{$errors->has('afternoon_end_time') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('afternoon_end_time') ? Request::old('afternoon_end_time') : (isset($system) ? $system->afternoon_end_time : '') }}">
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
                                    value="{{Request::old('image') ? Request::old('image') : (isset($system) ? $system->image : '') }}">
                            </div>
                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($system) ? url("$system->image") : '' }}">
                        </div>
                    </div>
                    @if(isset($system))
                    <input name="id" type="hidden" value="{{ $system->id }}">
                    @endif
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection