@extends('template')

@section('title')
    {{ isset($faq) ? 'ویرایش سوال' : 'سوال تازه' }}
@endsection

@section('content')
    <div class="row pt-3 mb-4 pb-5">
        <div class="col">
            <div class="card shadow rounded-lg border-0">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title d-inline text-success">
                        {{ isset($faq) ? 'ویرایش سوال' : 'سوال تازه' }}
                    </h3>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/faqs") }}/{{isset($faq) ? 'edit' : 'add'}}"
                          enctype="multipart/form-data" id="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">سوال</label>
                                    <input name="question" id="title" type="text" required autofocus
                                           class="form-control {{$errors->has('question') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('question') ? Request::old('question') : (isset($faq) ? $faq->question : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">جواب</label>
                                    <input name="answer" id="title" type="text" required autofocus
                                           class="form-control {{$errors->has('answer') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('answer') ? Request::old('answer') : (isset($faq) ? $faq->answer : '') }}">
                                </div>
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($partner) ? $partner->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection