@extends('admin.admin-template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}">
@endsection

@section('content')
    <div class="col-10 bg-dark p-3 rounded-lg" style="box-shadow: 5px 5px 15px black">
        <form method="post" action="{{ isset($video) ? '/admin/video_edited' : '/admin/add_video' }}">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">عنوان</label>
                        <input name="title" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" value="{{ isset($video) ? $video->title : '' }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlInput1">قیمت (تومان)</label>
                        <input name="price" type="text" class="form-control bg-transparent text-gold border-gold"
                               id="exampleFormControlInput1" placeholder="0 = رایگان" value="{{ isset($video) ? $video->price : '' }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label class="text-gold" for="exampleFormControlSelect1">مربوط به دوره:</label>
                        <select name="course_id" class="form-control bg-transparent text-gold border-gold pt-0 pr-1"
                                id="exampleFormControlSelect1">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                        {{ isset($video) ? $video->course_id==$course->id ? 'selected' : '' : '' }} class="text-dark"> {{ $course->title . ' | مهندس ' . $course->teacher->last_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <label class="text-gold" for="exampleFormControlInput1">فایل ویدئو</label>
                    <input id="thumbnail" class="form-control form-control bg-transparent text-gold border-gold" type="text"
                           name="filepath" value="{{ isset($video) ? $video->video_address : '' }}">
                    <span class="input-group-btn">
                            <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-gold">
                                <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </span>
                </div>
                @if(isset($video))
                    <input type="hidden" name="video_id" value="{{$video->id}}">
                @endif
            </div>
            <div class="row">
                <div class="col-2 mx-auto text-center">
                    <button type="submit"
                            class="btn btn-success">{{ isset($video) ? 'ثبت تغییرات' : 'افزودن ویدئو' }}</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            var domain = "";
            $('#lfm').filemanager('file');
        })
    </script>
@endsection
