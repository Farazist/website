@extends('template')

@section('title')
    پسماند های مالک
@endsection
@section('content')
    @if($owner)
        <div class="row pt-3">
            <div class="col">
                <div class="card shadow rounded-lg border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                کد مالک:
                                {{$owner->id}}
                            </div>
                            <div class="col-md-4">
                                نام:
                                {{$owner->name}}
                            </div>
                            <div class="col-md-4">
                                شماره همراه:
                                {{$owner->mobile_number}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row pt-3 mb-5 pb-5">
        <div class="col">
            <div class="card shadow rounded-lg border-0">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title d-inline text-success">
                        پسماندهای مالک
                    </h3>
                    <a href="{{ url("/admin/owners/$owner->id/items/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control bg-light border-0" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if($items->count() == 0)
                        <h3 class="card-title">پسماندی وجود ندارد</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover small">
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
                                        <td class="align-middle fit">
                                            <a href="{{ url("/admin/owners/$owner->id/items/$item->id/edit") }}"
                                                class="btn-outline-info btn btn-sm">
                                                <span class="fad fa-pen fa-fw"></span>
                                            </a>
                                            <button type="button" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{$item->id}}" class="btn-outline-danger btn btn-sm">
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
            btn_delete.attr("href", '{{ URL::asset("/admin/owners/$owner->id/items") }}' + '/' + id + '/delete');
        })
    </script>
@endsection