@extends('template')

@section('title')
تراکنش ها
@endsection
@section('content')
<div class="row pt-3 mb-3">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        کد کاربر: 
                        {{$citizen->id}}
                    </div>
                    <div class="col-md-3">
                        نام: 
                        {{$citizen->name}}
                    </div>
                    <div class="col-md-3">
                        شماره همراه: 
                        {{$citizen->mobile_number}}
                    </div>
                    <div class="col-md-3">
                        کیف پول: 
                        {{$citizen->wallet}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    تراکنش ها
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if($citizen->transactions->count() == 0)
                <h3 class="card-title">تراکنشی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">کد </th>
                                <th scope="col">مقدار </th>
                                <th scope="col">تاریخ </th>
                                <th scope="col">توضیح</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($citizen->transactions as $transaction)
                            <tr>
                                <td>
                                    @if($transaction->amount > 0)
                                    <span class="fad fa-arrow-to-bottom fa-2x text-success fa-fw"></span>
                                    @else
                                    <span class="fad fa-arrow-from-bottom fa-2x text-danger fa-fw"></span>
                                    @endif
                                </td>
                                <th class="align-middle">{{$transaction->id}}</th>
                                <td class="align-middle">{{ abs($transaction->amount) }}</td>
                                <td class="align-middle">{{$transaction->created_at}}</td>
                                <td class="align-middle">{{$transaction->description}}</td>
                                
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
        btn_delete.attr("href", '{{ URL::asset("/admin/citizen/delete") }}' + '/' + id);
    })
</script>
@endsection