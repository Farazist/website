@extends('template')

@section('title')
پست ها
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
        <div class="card shadow rounded-lg border-0">
            <div class="card-header bg-transparent border-0">
                <h3 class="card-title d-inline text-success">
                    پست ها
                </h3>
                <a href="{{ URL::asset("/admin/blog/add") }}" class="btn btn-success float-left">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                <br>
                @if(count($topics) == 0)
                <h5 class="card-title">پستی وجود ندارد</h5>
                @else
                <table class="table table-striped table-hover small">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="10%">تصویر</th>
                            <th scope="col" width="30%">عنوان</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($topics as $topic)
                        <tr>
                            <th scope="row" class="align-middle">{{$topic->id}}</th>
                            <td>
                                <img class="img-fluid rounded" src="{{ URL::asset("$topic->image") }}">
                            </td>
                            <td class="align-middle">
                                <a href="{{ URL::asset("/blog/" . $topic->category->name . "/" .$topic->id) }}"
                                    class="text-info">
                                    {{$topic->title}}
                                </a>
                            </td>
                            <td class="align-middle">
                                {{$topic->created_time}}
                                <br>
                                {{$topic->created_date}}
                            </td>
                            <td class="align-middle">
                                <a href="{{ URL::asset("/admin/blog/edit/$topic->id") }}"
                                    class="btn-outline-info btn btn-sm">
                                    <span class="fas fa-pen fa-fw"></span>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#deleteModal"
                                    data-id="{{$topic->id}}" class="btn-outline-danger btn btn-sm">
                                    <span class="fas fa-trash fa-fw"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <nav aria-label="Page navigation example">
                                {{ $topics->links("pagination::bootstrap-4") }}
                            </nav>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer text-muted">
                برای افزودن پست تازه <i class="fas fa-plus-square"></i> را بزنید
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var btn_delete = $(this).find('.modal-footer #btn-delete');
        btn_delete.attr("href", '{{ URL::asset("/admin/blog/topic/delete") }}' + '/' + id);
    })
</script>
@endsection