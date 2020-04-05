@extends('admin.template')

@section('title')
    {{ isset($menu) ? 'ویرایش منو' : 'منو تازه' }}
@endsection

@section('content')

    <div class="card shadow rounded-lg border-0 pt-2">
        <div class="card-header bg-transparent border-0">
            <h3 class="card-title d-inline text-danger">
                {{ isset($menu) ? 'ویرایش منو' : 'منو تازه' }}
            </h3>
            <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
        </div>
        <div class="card-body">
            <form method="post" action="{{ URL::asset("/admin/menu") }}/{{ isset($menu) ? 'edit' : 'add' }}" id="form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>عنوان</label>
                                <input name="title" type="text" placeholder="Title" required autofocus
                                       class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('title') ? Request::old('title') : (isset($menu) ? $menu->title : '') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>لینک</label>
                                <input type="text" name="link" placeholder="Link"
                                       class="form-control {{$errors->has('link') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('link') ? Request::old('link') : (isset($menu) ? $menu->link : '') }}">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label>نشان</label>
                                <input type="text" name="icon" placeholder="Font Awesome Icon"
                                       class="form-control {{$errors->has('icon') ? 'is-invalid' : ''}}"
                                       value="{{Request::old('icon') ? Request::old('icon') : (isset($menu) ? $menu->icon : '') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>پدر</label>
                                <select class="form-control" name="parent_id">
                                    <option
                                        value="0" {{Request::old('parent_id') && Request::old('parent_id') == '0' ? 'selected' : (isset($menu) && $menu->parent_id == '0' ? 'selected' : '') }}>
                                        منوی اصلی
                                    </option>
                                    @foreach($parent_menus as $parent_menu)
                                        <option
                                            value="{{$parent_menu->id}}" {{Request::old('parent_id') && Request::old('parent_id') == $parent_menu->id ? 'selected' : (isset($menu) && $menu->parent_id == $parent_menu->id ? 'selected' : '') }}>
                                            {{$parent_menu->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ترتیب</label>
                                <input type="number" name="order" placeholder="Order"
                                       class="form-control {{$errors->has('order') ? 'is-invalid' : ''}}"
                                       value="{{ Request::old('order') ? Request::old('order') : (isset($menu) ? $menu->order : '') }}">
                            </div>
                        </div>

                        <input name="id" type="hidden" value="{{ isset($menu) ? $menu->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
