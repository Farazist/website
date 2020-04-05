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
    <meta name="author" content="Sajjad Aemmi">
    <meta name="description"
        content="@yield('description', '')">
    <meta name="keywords"
        content="@yield('keywords','بازیافت,بازیافت هوشمند,تحویل پسماند,شارژ ساختمان,بیمه,خیریه,ECO,RVM,شارژ سیم کارت,پرداخت قبض,تحویل پکیج')">

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
    <div class="preloader_wrapper">
        <div class="preloader_inner">
            <img src="{{ url('/images/farazist.svg') }}" width="64px" alt="image" />
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

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="/__/firebase/7.8.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="/__/firebase/7.8.2/firebase-analytics.js"></script>

    <!-- Initialize Firebase -->
    <script src="/__/firebase/init.js"></script>
</body>

</html>