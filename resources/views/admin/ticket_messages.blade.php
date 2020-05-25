@extends('template')

@section('title')
پیام ها
@endsection
@section('content')
<div class="row pt-3 mb-3">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid rounded-circle" width="32px" src="{{ URL::asset($ticket->user->image) }}">
                        {{$ticket->user->name}}
                    </div>
                    <div class="col-md-4">
                        شناسه تیکت:
                        {{$ticket->id}}
                    </div>
                    <div class="col-md-4">
                        موضوع:
                        {{$ticket->subject}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($ticket->messages as $message)
<div class="row mb-3">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            @if($message->type == 'send')
            <div class="card-header bg-primary text-white">
                {{ $ticket->user->name }}
                <small>
                    ({{$message->created_at}})
                </small>
            </div>
            @elseif($message->type == 'receive')
            <div class="card-header bg-success text-white">
                فرازیست
                <small>
                    ({{$message->created_at}})
                </small>
            </div>
            @endif
            <div class="card-body">
                <p>
                    {{$message->text}}
                </p>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="row mb-5 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-success text-white">
                فرازیست
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form" action="{{ URL::asset("/admin/pages") }}">
                    <div class="form-group">
                        <textarea name="body" id="editor"
                            class="form-control">{{Request::old('body') ? Request::old('body') : (isset($page) ? $page->body : '') }}</textarea>

                    </div>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/ticket/delete") }}' + '/' + id);
    })
</script>
@endsection