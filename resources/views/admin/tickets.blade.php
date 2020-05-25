@extends('template')

@section('title')
تیکت ها
@endsection
@section('content')
<div class="row pt-3 mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    تیکت ها
                </h3>
            </div>
            <div class="card-body">
                <input class="form-control bg-light border-0" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($tickets) == 0)
                <h3 class="card-title">تیکتی وجود ندارد</h3>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover small mb-0">
                        <thead>
                            <tr>
                                <th scope="col" width="64px"></th>
                                <th scope="col">نام کاربر</th>
                                <th scope="col">موضوع</th>
                                <th scope="col">شناسه</th>
                                <th scope="col">بخش</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <img class="img-fluid rounded-circle" src="{{ URL::asset($ticket->user->image) }}">
                                </td>
                                <th class="align-middle" scope="row">{{$ticket->user->name}}</th>
                                <td class="align-middle">{{$ticket->subject}}</td>
                                <td class="align-middle">{{$ticket->id}}</td>
                                <td class="align-middle">{{$ticket->group->title}}</td>
                                <td class="align-middle">{{$ticket->state}}</td>
                                <td class="align-middle fit">
                                    <a href="{{ url("/admin/tickets/$ticket->id/messages") }}"
                                        class="btn-outline-success btn btn-sm">
                                        پیام ها
                                        <span class="fad fa-comments-alt fa-fw"></span>
                                    </a>
                                </td>
                                <td class="align-middle fit">
                                    <a href="{{ URL::asset("/admin/tickets/$ticket->id/edit") }}"
                                        class="btn-outline-info btn btn-sm">
                                        <span class="fad fa-pen fa-fw"></span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{$ticket->id}}" class="btn-outline-danger btn btn-sm">
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
        btn_delete.attr("href", '{{ url("/admin/tickets") }}' + '/' + id + '/delete');
    })
</script>

@endsection