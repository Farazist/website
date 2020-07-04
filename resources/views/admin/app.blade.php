@extends('template')

@section('title')
    {{ 'نرم افزار موبایل' }}
@endsection

@section('content')
    <div class="row pt-3 mb-5 pb-5">
        <div class="col">
            <div class="card shadow rounded-lg border-0">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title d-inline text-success">
                        {{ 'نرم افزار موبایل' }}
                    </h3>
                    <button type="submit" class="btn btn-success float-left" form="form">بارگزاری</button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/app/add") }}"
                          enctype="multipart/form-data" id="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="id">فایل نرم افزار</label>
                                        <input name="app" id="id" type="file" readonly class="form-control">
                                    </div>
                                </div>
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