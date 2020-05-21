@extends('template')

@section('title')
مالکان
@endsection
@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    مالکان
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control bg-light border-0" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($owners) == 0)
                <h3 class="card-title">مالکی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">شناسه</th>
                                <th scope="col">شماره همراه</th>
                                <th scope="col">تاریخ عضویت</th>
                                <th scope="col">کیف پول</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($owners as $owner)
                            <tr>
                                <td>
                                    @if($owner->image)
                                    <img src="{{ $owner->image }}" class="img-fluid rounded-circle" alt="...">
                                    @else
                                    <span class="fad fa-user fa-3x text-success fa-fw"></span>
                                    @endif
                                </td>
                                <td class="align-middle">{{$owner->name}}</td>
                                <td class="align-middle">{{$owner->id}}</td>
                                <td class="align-middle">{{$owner->mobile_number}}</td>
                                <td class="align-middle">{{$owner->created_date}}</td>
                                <td class="align-middle">
                                    {{$owner->wallet}}
                                    تومان
                                </td>
                                <td class="align-middle fit">
                                    <a href="{{ url("/admin/owners/$owner->id/transactions") }}"
                                        class="btn-outline-success btn btn-sm">
                                        تراکنش ها
                                        <span class="fad fa-exchange fa-fw"></span>
                                    </a>
                                    <a href="{{ url("/admin/owners/$owner->id/deliveries") }}"
                                        class="btn-outline-success btn btn-sm">
                                        تحویل ها
                                        <span class="fad fa-recycle fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle fit">
                                    <a href="{{ url("/admin/owners/$owner->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fad fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$owner->id}}" class="btn-outline-danger btn btn-sm">
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
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ url("/admin/owners") }}' + '/' + id + '/delete');
    })
</script>
@endsection