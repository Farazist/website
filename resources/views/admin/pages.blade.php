@extends('template')

@section('title')
    برگه ها
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col">
    <div class="card shadow rounded-lg border-0 pt-2">
        <div class="card-header bg-transparent border-0">
            <h3 class="card-title d-inline text-success">
                برگه ها
            </h3>
            <a href="{{ URL::asset("/admin/pages/add") }}" class="btn btn-success float-left">
                <span class="fas fa-plus"></span>
            </a>
        </div>
        <div class="card-body">
            <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
            <br>
            @if(count($pages) == 0)
                <h5 class="card-title">برگه وجود ندارد</h5>
            @else
                <table class="table table-striped table-hover border small">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" width="10%">تصویر</th>
                        <th scope="col">عنوان</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @foreach($pages as $page)
                        <tr>
                            <th scope="row" class="align-middle">{{$page->id}}</th>
                            <td>
                                <img class="img-fluid rounded"
                                     src="{{ URL::asset("$page->image") }}">
                            </td>
                            <td class="align-middle">
                                <a href="" class="text-success">
                                    {{$page->title}}
                                </a>
                            </td>
                            <td class="align-middle fit">
                                <a href="{{ URL::asset("/admin/pages/edit/$page->id") }}"
                                   class="btn-outline-info btn btn-sm">
                                    <span class="fas fa-pen fa-fw"></span>
                                </a>
                                <button type="button" data-toggle="modal"
                                        data-target="#deleteModal"
                                        data-id="{{$page->id}}"
                                        class="btn-outline-danger btn btn-sm">
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
                                {{ $pages->links("pagination::bootstrap-4") }}
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer text-muted">
            برای افزودن برگه تازه <i class="fas fa-plus-square"></i> را بزنید
        </div>
    </div>
    </div>
    </div>

    <script>

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/page/delete") }}' + '/' + id);
        })
    </script>
@endsection
