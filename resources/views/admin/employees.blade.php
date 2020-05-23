@extends('template')

@section('title')
تیم ما
@endsection
@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    تیم ما
                </h3>
                <a href="{{ url("/admin/employees/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($employees) == 0)
                <h3 class="card-title">همکاری وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small mb-0">
                        <thead>
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">نام</th>
                                <th scope="col">توضیح</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <img class="img-fluid rounded-circle" src="{{ URL::asset("$employee->image") }}">
                                </td>
                                <th class="align-middle" scope="row">{{$employee->name}}</th>
                                <td class="align-middle">{!! $employee->explanation !!}</td>
                                <td class="align-middle">{{$employee->email}}</td>
                                <td class="align-middle fit">
                                    <a href="{{ URL::asset("/admin/employees/$employee->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fad fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$employee->id}}" class="btn-outline-danger btn btn-sm">
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
                برای افزودن همکار جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ url("/admin/employees") }}' + '/' + id + '/delete');
    })
</script>

@endsection