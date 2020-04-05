@extends('admin.admin-template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark p-3 rounded-lg" style="box-shadow: 5px 5px 15px black">
        <form method="post" action="{{ isset($course) ? URL::asset('/admin/course_edited') : URL::asset('/admin/add_course') }}">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">عنوان دوره</label>
                        <input name="title" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($course) ? $course->title : '' }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlSelect1">استاد درس</label>
                        <select name="teacher" class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                id="exampleFormControlSelect1">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                        {{ isset($course) ? $course->teacher_id==$teacher->id ? 'selected' : '' : '' }} class="text-dark">
                                    مهندس {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlSelect1">سطح دوره</label>
                        <select name="level" class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                id="exampleFormControlSelect1">
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}"
                                        {{ isset($course) ? $course->level_id==$level->id ? 'selected' : '' : '' }} class="text-dark"> {{ $level->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlSelect1">دسته بندی</label>
                        <select name="category" class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ isset($course) ? $course->category_id==$category->id ? 'selected' : '' : '' }} class="text-dark"> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group text-dark">
                        <label class="text-light" for="exampleFormControlTextarea1">متن اطلاعیه</label>
                        <textarea name="announcement" class="form-control text-dark" id="editor"
                                  rows="3">{{ isset($course) ? $course->announcement : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-light" for="exampleFormControlTextarea1">سرفصل ها</label>
                        <textarea name="headlines" class="form-control" id="editor2"
                                  rows="3">{{ isset($course) ? $course->headlines : '' }}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">توصیف</label>
                        <input name="description" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($course) ? $course->description : '' }}">
                    </div>
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">کلمات کلیدی</label>
                        <input name="keywords" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($course) ? $course->keywords : '' }}">
                    </div>
                    <label class="text-gold" for="exampleFormControlInput1">آواتار</label>
                    <input id="thumbnail" class="form-control form-control bg-transparent text-gold border-gold" type="text"
                           name="filepath" value="{{ isset($course) ? $course->avatar_address : '' }}">
                    <span class="input-group-btn">
                            <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-gold">
                                <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </span>
                    <img id="holder" style="margin-top:15px;max-height:100px;"
                         src="{{ isset($course) ? $course->avatar_address : '' }}">
                </div>
                @if(isset($course))
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                @endif
                <div class="col-2 mr-auto">
                    <button type="submit"
                            class="btn btn-success offset-5">{{ isset($course) ? 'ثبت تغییرات' : 'افزودن دوره' }}</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
        ClassicEditor
            .create(document.querySelector('#editor2'))
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
