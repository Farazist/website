@extends('template')

@section('title')
دستگاه ها
@endsection

@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    دستگاه ها
                </h3>
                <a href="{{ URL::asset("/admin/systems/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control bg-light border-0" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($systems) == 0)
                <h3 class="card-title">دستگاهی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small mb-0">
                        <thead>
                            <tr>
                                <th scope="col" width="100px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">شناسه</th>
                                <th scope="col">شهر </th>
                                <th scope="col">آدرس </th>
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
                                <td class="align-middle">{{$system->id}}</td>
                                <td class="align-middle">{{$system->city->name}}</td>
                                <td class="align-middle">{{$system->address}}</td>
                                <td class="align-middle">{{$system->owner->name}}</td>
                                <td class="align-middle text-center">
                                    @if($system->state == 'active')
                                    <span class="fad fa-circle fa-2x text-success fa-fw"></span>
                                    @else
                                    <span class="fad fa-circle fa-2x text-secondary fa-fw"></span>
                                    @endif
                                </td>

                                <td class="align-middle fit">
                                    <a href="{{ URL::asset("/admin/systems/$system->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fad fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$system->id}}" class="btn-outline-danger btn btn-sm">
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
                برای افزودن دستگاه جدید <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ url("/admin/systems") }}' + '/' + id + '/delete');
    })
</script>
@endsection