<nav class="navbar navbar-expand-lg navbar-light bg-white position-sticky shadow-sm" style="top: 0; z-index: 4">

    @auth
    <button class="btn text-success ml-4" id="btn-toogle-sidebar">
        <span class="fad fa-bars fa-lg"></span>
    </button>
    @endauth

    <a href="{{ url("/") }}" class="navbar-brand">
        <img src="{{ url('/images/logo.png') }}" height="40px" alt="farazist logo" />
    </a>
    <div class="order-md-2 order-1">
        <a href="#download-app" id="download-app" class="btn btn-success rounded-pill d-md-inline d-sm-block">
            <span class="fab fa-android"></span>
            دانلود فرازیست
        </a>
        <a>
            <i class="fad fa-search pr-3" id="search_toggle" aria-hidden="true"></i>
        </a>
        <i data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" class="fad fa-bars fa-lg navbar-toggler p-0 pr-3 border-0"></i>
    </div>
    <div class="collapse navbar-collapse order-md-1 order-2" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @foreach($menus as $menu)
            <li class="nav-item active">
                <a class="nav-link" href="{{ url("/$menu->url") }}" id="{{ $menu->id_attr }}">{{$menu->title}}</a>
            </li>
            @endforeach
        </ul>
    </div>

</nav>

<!--Popup-->
<div class="search">
    <div class="search_block">
        <h3 class="text-white">
            بیشتر کاوش کنید
        </h3>
        <div class="search_field">
            <input type="search" placeholder="جستجو..." />
            <a href="javascript:;">
                <span class="fad fa-search"></span>
            </a>
        </div>
    </div>
    <span class="fa fa-times search_close fa-3x text-white">
    </span>
</div>