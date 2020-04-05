@extends('template')

@section('title')
فراسیستم
@endsection
@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    فراسیستم
                </h3>
            </div>
            <div class="card-body">
                @if(count($systems) == 0)
                <h3 class="card-title">فراسیستمی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="100px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">آدرس </th>
                                <th scope="col">شهر </th>
                                <th scope="col">مالک </th>
                                <th scope="col">وضعیت </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($systems as $system)
                            <tr>
                                <td>
                                    <img class="img-fluid rounded" src="{{ URL::asset("$system->image") }}">
                                </td>
                                <td class="align-middle">{{$system->name}}</td>
                                <td class="align-middle">{{$system->address}}</td>
                                <td class="align-middle">{{$system->city->name}}</td>
                                <td class="align-middle">{{$system->owner->name}}</td>
                                <td class="align-middle text-center">
                                    @if($system->state == 'active')
                                    <span class="fad fa-circle fa-2x text-success fa-fw"></span>
                                    @else
                                    <span class="fad fa-circle fa-2x text-secondary fa-fw"></span>
                                    @endif
                                </td>

                                <td class="align-middle text-left">
                                    <a href="{{ URL::asset("/admin/system/edit/$system->id") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fas fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$system->id}}" class="btn-outline-danger btn btn-sm">
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
                برای افزودن فراسیستم جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>


<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/system/delete") }}' + '/' + id);
    })
</script>
@endsection