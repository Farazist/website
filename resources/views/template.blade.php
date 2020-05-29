<!doctype html>
<html>

<head>
    <title>
        فرازیست -
        @yield('title')
    </title>

    @yield('style')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="application-name" content="Farazist">
    <meta name="author" content="Sajjad Aemmi, Emad Aemi">
    <meta name="description" content="@yield('description', $description->value)">
    <meta name="keywords" content="@yield('keywords', $keywords->value)">

    <meta property="og:title" content="فرازیست" />
    <meta property="og:url" content="@yield('url','https://farazist.ir')" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Farazist" />
    <meta property="og:description"
        content="@yield('description', 'فرایند هوشمند بازیافت، دریافت پول در ازای تحویل پسماند های خشک')" />
    <meta property="og:image" content="{{ url('/images/logo.png') }}" />
    <meta name="robots" content="index, follow" />

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('/images/logo.png') }}">
    <meta name="theme-color" content="#17a2b8">
    <meta name="msapplication-navbutton-color" content="#17a2b8">
    <meta name="apple-mobile-web-app-status-bar-style" content="#17a2b8">

    <link rel="apple-touch-icon" href="{{ url('/images/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ url('/images/logo.png') }}" />
    <link rel="icon" href="{{ url('/images/favicon.ico') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ url('/images/favicon.ico') }}' />

    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery.md.bootstrap.datetimepicker.style.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/jquery.gScrollingCarousel.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/range.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">

    <script src="{{ url('/js/jquery-3.4.1.js') }}"></script>
    <script src="{{ url('/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.js') }}"></script>
    <script src="{{ url('/js/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ url('/js/jquery.gScrollingCarousel.js') }}"></script>

    <script src="{{ url('/js/script.js') }}"></script>

    <script src="{{ url('/js/ckeditor.js') }}"></script>
    @include('ckfinder::setup')

    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('
                services.recaptcha.sitekey ') }}', {
                    action: 'contact'
                }).then(function (token) {
                if (token) {
                    var recaptcha = document.getElementById('recaptcha');
                    if (recaptcha) {
                        recaptcha.value = token;
                    }
                }
            });
        });
    </script>
</head>

<body class="bg-light">

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
       <div class="modal-dialog modal-sm" role="document">
           <div class="modal-content">
               <div class="modal-body">
                   <p class="mb-0">آیا برای حذف اطمینان دارید؟</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">برگشت</button>
                   <a href="#" class="btn-danger btn" id="btn-delete">
                       حذف
                   </a>
               </div>
           </div>
       </div>
   </div>

   
    <div class="preloader_wrapper">
        <div class="preloader_inner">
            <img src="{{ url('/images/logo.png') }}" width="64px" alt="farazist logo" />
        </div>
    </div>
    <div class="row">
        @auth
        <aside class="p-0" id="sidebar">
            @include('includes.sidebar')
        </aside>
        @endauth
        <main class="col p-0 position-relative w-25">

            @include('includes.header')
   
            @if(Session::has('message'))
            <div class="row pt-3 pb-0">
                <div class="col-12">
                    <div class="alert alert-info mb-0" role="alert">
                        {{Session::get('message')}}
                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            
            @yield('content')
            @include('includes.footer')
        </main>
    </div>

    <script type="text/javascript">
        $('#date').MdPersianDateTimePicker({
            targetTextSelector: '#inputDate',
            dateFormat: 'yyyy-MM-dd',
        });
    </script>

    <!--Main js file Style-->
    <script src="{{ url('/js/swiper.min.js') }}"></script>
    <script src="{{ url('/js/magnific-popup.min.js') }}"></script>
    <script src="{{ url('/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ url('/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ url('/js/jquery.appear.js') }}"></script>
    <script src="{{ url('/js/jquery.countTo.js') }}"></script>
    <script src="{{ url('/js/isotope.min.js') }}"></script>
    {{-- <script src="{{ url('/js/nice-select.min.js') }}"></script>
    <script src="{{ url('/js/range.js') }}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="{{ url('/js/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ url('/js/revolution.extension.video.min.js') }}"></script> --}}
    <script src="{{ url('/js/custom.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>