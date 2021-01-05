@extends('template')

@section('title')
درخواست های پول نقد
@endsection
@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    درخواست های پول نقد
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control bg-light border-0" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($money_requests) == 0)
                <h3 class="card-title">درخواستی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">شناسه</th>
                                <th scope="col">شماره همراه</th>
                                <th scope="col">شماره کارت</th>
                                <th scope="col">مبلغ درخواستی</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($money_requests as $money_request)
                            <tr>
                                <td>
                                    @if($money_request->user->image)
                                    <img loading="lazy" loading="lazy" loading="lazy" loading="lazy" src="{{ $money_request->user->image }}" class="img-fluid rounded-circle" alt="...">
                                    @else
                                    <span class="fad fa-user fa-3x text-success fa-fw"></span>
                                    @endif
                                </td>
                                <td class="align-middle">{{$money_request->user->name}}</td>
                                <td class="align-middle">{{$money_request->user->id}}</td>
                                <td class="align-middle">{{$money_request->user->mobile_number}}</td>
                                <td class="align-middle">{{$money_request->user->card_number}}</td>
                                <td class="align-middle">
                                    {{$money_request->amount}}
                                    تومان
                                </td>
                                
                                <td class="align-middle fit">
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$money_request->id}}" class="btn-outline-danger btn btn-sm">
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
        btn_delete.attr("href", '{{ url("/admin/citizens") }}' + '/' + id + '/delete');
    })
</script>
@endsection