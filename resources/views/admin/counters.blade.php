@extends('template')

@section('title')
شمارنده ها
@endsection
@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    شمارنده ها
                </h3>
            </div>
            <div class="card-body">
                @if(count($counters) == 0)
                <h3 class="card-title">شمارنده ای وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="100px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">توضیح </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($counters as $counter)
                            <tr>
                                <td>
                                    <span class="fad fa-{{$counter->icon}} fa-3x"></span>
                                </td>
                                <td class="align-middle">{{$counter->name}}</td>
                                <td class="align-middle">{{$counter->value}}</td>

                                <td class="align-middle text-left">
                                    <a href="{{ URL::asset("/admin/counter/edit/$counter->id") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fas fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$counter->id}}" class="btn-outline-danger btn btn-sm">
                                        <span class="fas fa-trash fa-fw"></span>
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
                برای افزودن دوره جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>


<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/counter/delete") }}' + '/' + id);
    })
</script>
@endsection