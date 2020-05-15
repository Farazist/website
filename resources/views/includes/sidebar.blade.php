<div class="p-3 bg-success position-fixed h-100">

    @auth
    <div class="row text-center border-0">
        <div class="col">
            @if(Auth::user()->image)
            <img src="{{ Auth::user()->image }}" class="img-fluid rounded-circle w-50" alt="...">
            @else
            <span class="fad fa-user fa-5x text-white"></span>
            @endif
            <h4 class="card-title my-3 text-white">
                {{Auth::user()->name}}
            </h4>
        </div>
    </div>
    <hr>
    <div class="list-group">
        @foreach(Auth::user()->menus()->orderBy('order', 'ASC')->get() as $menu)
        <a href="{{ url("$menu->url") }}" class="list-group-item rounded-lg {{Request::has($menu->url) ? 'bg-light':''}}">
            <span class="fad fa-{{ $menu->icon }} fa-fw ml-2"></span>
            {{ $menu->title }}
        </a>
        @endforeach
    </div>
    @endauth
</div>