@extends('template')

@section('title')
آیتم ها
@endsection
@section('content')
@if($citizen)
<div class="row pt-3">
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
@endif
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    آیتم ها
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if($items->count() == 0)
                <h3 class="card-title">آیتمی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">کد </th>
                                <th scope="col">نام </th>
                                <th scope="col">قیمت </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                    <img src="{{ $item->image }}" class="img-fluid" alt="...">
                                    @else
                                    <span class="fad fa-wine-bottle fa-3x text-success fa-fw"></span>
                                    @endif
                                </td>
                                <th class="align-middle">{{$item->id}}</th>
                                <td class="align-middle">{{$item->name}}</td>
                                <td class="align-middle">{{$item->price}}</td>
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