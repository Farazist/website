@extends('template')

@section('title')
تحویل ها
@endsection
@section('content')

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

<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    تحویل ها
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if($citizen->deliveries->count() == 0)
                <h3 class="card-title">تحویلی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">کد </th>
                                <th scope="col">تاریخ </th>
                                <th scope="col">زمان </th>
                                <th scope="col">نام فراسیستم</th>
                                <th scope="col">نام مالک</th>
                                <th scope="col">مقدار </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($citizen->deliveries as $delivery)
                            <tr>
                                <th class="align-middle">{{$delivery->id}}</th>
                                <td class="align-middle">{{jdate('Y/m/d', strtotime($delivery->created_at))}}</td>
                                <td class="align-middle">{{jdate('H:i:s', strtotime($delivery->created_at))}}</td>
                                <td class="align-middle">{{$delivery->system->name}}</td>
                                <td class="align-middle">{{$delivery->system->owner->name}}</td>
                                <td class="align-middle">{{ abs($delivery->amount) }}</td>
                                <td class="align-middle">
                                    <a href="{{ url("/admin/citizens/$citizen->id/deliveries/$delivery->id") }}"
                                        class="btn-outline-success btn btn-sm">
                                        آیتم ها
                                        <span class="fad fa-wine-bottle fa-fw"></span>
                                    </a>
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
        btn_delete.attr("href", '{{ URL::asset("/admin/citizen/delete") }}' + '/' + id);
    })
</script>
@endsection