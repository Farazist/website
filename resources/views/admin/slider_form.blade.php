@extends('template')

@section('title')
    {{ isset($slider) ? 'ویرایش اسلایدر' : 'اسلایدر تازه' }}
@endsection
@section('content')

    <div class="card shadow rounded-lg border-0 pt-2">
        <div class="card-header bg-transparent border-0">
            <h3 class="card-title d-inline text-success">
                {{ isset($slider) ? 'ویرایش اسلایدر' : 'اسلایدر تازه' }}
            </h3>
            <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="form"
                  action="{{ url("/admin/systems/$system->id/sliders") }}/{{ isset($slider) ? 'edit' : 'add' }}">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>عنوان</label>
                                <input name="title" type="text" placeholder="Title" autofocus
                                       class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('title') ? Request::old('title') : (isset($slider) ? $slider->title : '') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>لینک</label>
                                <input name="url" type="text" placeholder="Url"
                                       class="form-control {{$errors->has('url') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('url') ? Request::old('url') : (isset($slider) ? $slider->url : '')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>توضیح</label>
                            <textarea name="caption"
                                      id="editor">{{Request::old('caption') ? Request::old('caption') : (isset($slider) ? $slider->caption : '') }}</textarea>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($slider) ? $slider->id : '' }}">
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
                               value="{{Request::old('image') ? Request::old('image') : (isset($slider) ? $slider->image : '') }}">
                        <img id="img-preview" class="img-fluid rounded-lg"
                             src="{{ isset($slider) ? URL::asset("$slider->image") : '' }}">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



