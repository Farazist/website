@extends('admin.template')

@section('title')
    منو
@endsection
@section('content')

            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title d-inline text-danger">
                        منو
                    </h3>
                    <a href="{{ URL::asset("/admin/menu/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    @if(count($menus) == 0)
                        <h3 class="card-title">منویی وجود ندارد</h3>
                    @else
                        <table class="table table-hover border">

                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ترتیب</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">لینک</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($menus as $menu)
                                <tr class="table-light">
                                    <td>{{$menu->order}}</td>
                                    <td>{{$menu->title}}</td>
                                    <td>{{$menu->link}}</td>
                                    <td align="left">
                                        <a href="{{ URL::asset("/admin/menu/edit/$menu->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$menu->id}}"
                                                class="btn-outline-danger btn btn-sm">
                                            <span class="fas fa-trash fa-fw"></span>
                                        </button>
                                    </td>
                                </tr>
                                @if(count($menu->childs) > 0)
                                    @foreach($menu->childs()->orderBy('order', 'asc')->get() as $submenu)
                                        <tr class="table-secondary">
                                            <td>
                                                {{$menu->order}}
                                                -
                                                {{$submenu->order}}
                                            </td>
                                            <td>{{$submenu->title}}</td>
                                            <td>{{$submenu->link}}</td>
                                            <td class="fit">
                                                <a href="{{ URL::asset("/admin/menu/edit/$submenu->id") }}"
                                                   class="btn-outline-info btn btn-sm">
                                                    <span class="fas fa-pen fa-fw"></span>
                                                </a>
                                                <button type="button" data-toggle="modal"
                                                        data-target="#deleteModal"
                                                        data-id="{{$submenu->id}}"
                                                        class="btn-outline-danger btn btn-sm">
                                                    <span class="fas fa-trash fa-fw"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/menu/delete") }}' + '/' + id);
        })
    </script>
@endsection
