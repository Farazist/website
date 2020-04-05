@extends('template')

@section('title')
پروفایل
@endsection

{{-- @section('description'){{$exam->description}}@endsection --}}

{{-- @section('keywords'){{$exam->keywords}}@endsection --}}

{{-- @section('image'){{ URL::asset($exam->image) }}@endsection --}}

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 id="exams" class="text-white">
            <i class="fa fa-ballot-check fa-fw ml-1"></i>
            آزمون های من
        </h3>
        <hr class="bg-info">
        <div class="row mb-4" id="overview">
            @if(Auth::user()->exams->count() == 0)
            <h3 class="card-title text-white">آزمونی وجود ندارد</h3>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50px"></th>
                            <th scope="col">دوره</th>
                            <th scope="col">استاد</th>
                            <th scope="col">کد</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">ساعت</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach(Auth::user()->exams as $exam)
                        <tr>
                            <td class="align-middle">
                                <img class="img-fluid rounded" src="{{ URL::asset($exam->course->image) }}">
                            </td>
                            <th class="align-middle">
                                <a href="{{ URL::asset("/course/" . str_replace(' ', '-', $exam->course->name)) }}"
                                    class="text-info">
                                    {{$exam->course->name}}
                                </a>
                            </th>
                            <td class="align-middle fit">{{$exam->course->teacher->name}}</td>
                            <td class="align-middle fit">{{$exam->code}}</td>
                            <td class="align-middle">{{$exam->date}}</td>
                            <td class="align-middle">{{$exam->time}}</td>
                            <td class="align-middle fit">
                                @if($exam->state == 1)

                                @elseif($exam->state == 2)
                                <a href="{{ url("/user/exams/$exam->id/start") }}" class="btn-success btn btn-block">
                                    <span class="fa fa-play fa-fw"></span>
                                    شروع آزمون
                                </a>
                                @elseif($exam->state == 3)
                                <a href="{{ url("/admin/exams/$exam->id/edit") }}" class="btn-outline-light btn btn-block">
                                    <span class="fa fa-ballot-check fa-fw"></span>
                                    مشاهده نتایج
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection