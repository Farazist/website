@extends('template')

@section('title')
اسلایدر
@endsection
@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0 pt-2">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    اسلایدر
                </h3>
                <a href="{{ url("/admin/systems/$system->id/sliders/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">

                @if(count($sliders) == 0)
                <h3 class="card-title">اسلایدری وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small mb-0">
                        <thead>
                            <tr>
                                <th scope="col">تصویر</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">توضیح</th>
                                <th scope="col">لینک</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td class="w-25">
                                    <img class="img-fluid rounded" src="{{ URL::asset("$slider->image") }}">

                                </td>
                                <td>{{$slider->title}}</td>
                                <td>{!! $slider->caption !!}</td>
                                <td>{{$slider->url}}</td>
                                <td class="fit">
                                    <a href="{{ url("/admin/sliders/edit/$slider->id") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fad fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$slider->id}}" class="btn-outline-danger btn btn-sm">
                                        <span class="fad fa-trash fa-fw"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="card-footer text-muted">
                برای افزودن اسلایدر جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/systems/$system->id/sliders") }}' + '/' + id + '/delete');
    })
</script>
@endsection