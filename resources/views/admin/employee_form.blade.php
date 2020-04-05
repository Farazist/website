@extends('template')

@section('title')
{{ isset($employee) ? 'ویرایش  همکار' : ' همکار تازه' }}
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    {{ isset($employee) ? 'ویرایش  همکار' : ' همکار تازه' }}
                </h3>
                <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
            </div>
            <div class="card-body">
                <form method="post" action="{{ URL::asset("/admin/employee") }}/{{ isset($employee) ? 'edit' : 'add' }}"
                    enctype="multipart/form-data" id="form">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>نام</label>
                                    <input name="name" type="text" placeholder="Name" required autofocus
                                        class="form-control rounded-lg {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('name') ? Request::old('name') : (isset($employee) ? $employee->name : '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>توضیح</label>
                                    <input type="text" name="explanation"
                                        class="form-control {{$errors->has('explanation') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('explanation') ? Request::old('explanation') : (isset($employee) ? $employee->explanation : '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>ایمیل</label>
                                    <input name="email" type="email" placeholder="Email" required
                                        class="form-control rounded-lg {{$errors->has('email') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('email') ? Request::old('email') : (isset($employee) ? $employee->email : '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>اینستاگرام</label>
                                    <input name="instagram" type="text" placeholder="Instagram" required
                                        class="form-control rounded-lg {{$errors->has('instagram') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('instagram') ? Request::old('instagram') : (isset($employee) ? $employee->instagram : '') }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>تلگرام</label>
                                    <input name="telegram" type="text" placeholder="Telegram" required
                                        class="form-control rounded-lg {{$errors->has('telegram') ? 'is-invalid' : ''}}"
                                        value="{{Request::old('telegram') ? Request::old('telegram') : (isset($employee) ? $employee->telegram : '') }}">
                                </div>
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
                                value="{{Request::old('image') ? Request::old('image') : (isset($employee) ? $employee->image : '') }}">

                            <img id="img-preview" class="img-fluid rounded-lg"
                                src="{{ isset($employee) ? URL::asset("$employee->image") : '' }}">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ isset($employee) ? $employee->id : '' }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection