@extends('admin.admin-template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark py-4 rounded-lg" style="box-shadow: 5px 5px 15px black">
        <form method="post" action="{{ isset($teacher) ? '/admin/teacher_edited' : '/admin/add_teacher' }}">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">نام</label>
                        <input name="first_name" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($teacher) ? $teacher->first_name : '' }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">نام خانوادگی</label>
                        <input name="last_name" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($teacher) ? $teacher->last_name : '' }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">شماره تلفن</label>
                        <input name="phone_number" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1"
                               value="{{ isset($teacher) ? $teacher->phone_number : '' }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlSelect1">تحصیلات</label>
                        <select name="education" class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                id="exampleFormControlSelect1">
                            @foreach($educations as $education)
                                <option value="{{ $education->id }}"
                                        {{ isset($teacher) ? $teacher->education_id==$education->id ? 'selected' : '' : '' }} class="text-dark"> {{ $education->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">دانشگاه محل فارغ التحصیلی</label>
                        <input name="university" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($teacher) ? $teacher->university : '' }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">آدرس ایمیل</label>
                        <input name="email_address" type="email" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1"
                               value="{{ isset($teacher) ? $teacher->email_address : '' }}">
                    </div>
                </div>
                <div class="col-4">
                    <label class="text-gold" for="exampleFormControlInput1">تصویر پروفایل</label>
                    <input id="thumbnail" class="form-control form-control bg-transparent text-gold border-gold" type="text"
                           name="filepath" value="{{ isset($teacher) ? $teacher->avatar_address : '' }}">
                    <span class="input-group-btn">
                            <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-gold">
                                <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </span>
                    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ isset($teacher) ? $teacher->avatar_address : '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group text-dark">
                        <label class="text-light" for="exampleFormControlTextarea1">درباره استاد</label>
                        <textarea name="about" class="form-control text-dark" id="editor"
                                  rows="3">{{ isset($teacher) ? $teacher->about : '' }}</textarea>
                    </div>
                </div>
                @if(isset($teacher))
                    <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                @endif
            </div>
            <div class="row mt-4">
                <div class="col-2 mx-auto">
                    <div class="col-2">
                        <button type="submit"
                                class="btn btn-success">{{ isset($teacher) ? 'ثبت تغییرات' : 'افزودن استاد' }}</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(document).ready(function () {
            var domain = "";
            $('#lfm').filemanager('image');
        })
    </script>
@endsection
