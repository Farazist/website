@extends('template')

@section('title')
صفحه اصلی
@endsection

@section('content')

<!--Banner Slider-->
<div class="clv_banner_slider">
    <div class="clv_slide">
        <div class="container">
            <div class="clv_slide_inner">
                <h1>فرازیست</h1>
                <h3>فرایند هوشمند بازیافت </h3>
                <p>

                </p>
                <a href="#download-app" id="download-app" class="btn btn-lg btn-success rounded-pill">
                    <span class="fab fa-android"></span>
                    دانلود فرازیست
                </a>
            </div>
        </div>
    </div>
</div>
<!--About-->
<div class="garden_about_wrapper clv_section">
    <div class="container">
        <!--Service-->
        <div class="garden_service_wrapper">
            <div class="row">
                @foreach($abouts as $about)
                <div class="col-lg-3 col-md-3">
                    <div class="garden_service_block">
                        <div class="service_image">
                            <span><img src="{{ url("$about->image") }}" alt="image" class="img-fluid w-75" /></span>
                        </div>
                        <h3>{{ $about->title }}</h3>
                        <p>{{ $about->caption }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="garden_about_section">
            <div class="row">
                <div class="col-md-6">
                    <div class="garden_about_image">
                        <img src="images/RVM.jpg" class="img-fluid" alt="image" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="garden_about_content">
                        <h2>
                            دستگاه هوشمند بازیافت در مبداء
                        </h2>
                        <h6>
                            دستگاه هوشمند بازیافت در مبداء در 6 مدل طراحی وتولید می گردد.
                        </h6>
                        <p style="text-align: justify">
                            شرکت اقتصاد سبز فرامرزی در سال ۱۳۹۱ با هدف و رویکرد حل مشکلات زیر ساختی در عرصه انرژی های
                            تجدید پذیر ، اقتصاد مقاومتی ، مدیریت هوشمند پسماند خشک و حفظ محیط زیست به شماره ثبت ۴۴۸۹۲
                            رسید.

                            شرکت اقتصاد سبز فرامرزی پس از اختراع دستگاه آسان بر نما به شماره ثبت اختراع 81029 در سال
                            1392 که رسالت ان جایگزینی داربست در اجرای نمای ساختمان است تولید و در سراسر کشور و صادرات
                            محصول فروش نموده و همین امر باعث نجات هموطنان زحمتکشمان در کشور گردید...
                        </p>

                        <div class="garden_contact_section">
                            <a href="javascript:;" class="clv_btn">بیشتر بخوانید...</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Counter Section-->
<div class="clv_counter_wrapper clv_section">
    <div class="container">
        <div class="counter_section">
            <div class="row">
                @foreach($counters as $counter)
                <div class="col-lg-3 col-md-3 col-6">
                    <div class="counter_block">
                        <span class="fad fa-{{ $counter->icon }} fa-3x text-white"></span>
                        <div class="counter_text mt-3">
                            <h4>
                                <span class="count_no" data-to="{{ $counter->value }}" data-speed="3000">
                                    {{ $counter->value }}
                                </span>
                            </h4>
                            <h5>{{ $counter->name }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!--Service 2-->
<div class="garden_service2_wrapper clv_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="clv_heading">
                    <h3>امکانات فرازیست</h3>
                    <div class="clv_underline"><img src="images/garden_underline.png" alt="image" /></div>
                    <p>کارهایی که می تونی انجام بدی</p>
                </div>
            </div>
        </div>
        <div class="garden_service2_section">
            <div class="row">
                @foreach($services as $service)
                <div class="col-md-4">
                    <div class="service2_block">
                        <div class="service2_image">
                            <img class="img-fluid w-25" src="{{ url("$service->image") }}" alt="image" />
                        </div>
                        <div class="service2_content">
                            <h3>
                                {{ $service->title }}
                            </h3>
                            <p>
                                {{ $service->caption }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div id="section-download-app"></div>
<div class="garden_service2_wrapper clv_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 px-5">
                <img src="{{ url('/images/farazist-android-app.png') }}" class="img-fluid">
            </div>
            <div class="col-md-9">
                <div class="clv_heading text-right">
                    <h3>
                        همین حالا فرازیست رو دانلود کن
                    </h3>
                </div>
                <p>
                    اپلیکیشن فرازیست هم اکنون بر روی سیستم عامل‌ android در دسترس است و می‌توانید با مراجعه به
                    لینک‌های زیر، آن را دریافت نمایید.
                </p>
                <a href="https://cafebazaar.ir/app/ir.farazist.farazist_app" class="m-2" target="_blank">
                    <img alt="App Store" src="{{ url('/images/bazaar.png') }}" width="150">
                </a>
                <a href="#" class="m-2">
                    <img alt="App Store" src="{{ url('/images/google-play.svg') }}" width="150">
                </a>
                <br>
                <a href="{{ url("/files/farazist.apk") }}" download class="btn btn-success btn-lg rounded-pill m-2 mt-4">
                    <span class="fab fa-android"></span>
                    دانلود مستقیم اپلیکیشن
                </a>
            </div>
        </div>
    </div>
</div>
<!--Blog-->
<div class="garden_blog_wrapper clv_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="clv_heading white_heading">
                    <h3>تازه چه خبر؟!</h3>
                    <div class="clv_underline"><img src="images/underline2.png" alt="image" /></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="garden_blog_slider">
                    <div class="garden_blog_slide">
                        <div class="agri_blog_inner">
                            <div class="row">
                                @foreach($topics as $topic)
                                <div class="col-lg-6 col-md-6">
                                    <div class="right_blog_block">
                                        <div class="right_blog_image">
                                            <img src="{{ url("$topic->image") }}" alt="image" />
                                        </div>
                                        <div class="right_blog_content">
                                            <span class="text-success">
                                                {{ $topic->created_at}}
                                            </span>
                                            <h3>
                                                <a href="blog_single.html">
                                                    {{ $topic->title}}
                                                </a>
                                            </h3>
                                            <p>
                                                {{ $topics[0]->body}}
                                            </p>
                                            <a href="#" class="text-success">
                                                بیشتر...
                                                <span class="fa fa-long-arrow-left" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Projects-->
<div class="garden_project_wrapper clv_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="clv_heading">
                    <h3>گالری تصاویر</h3>
                    <div class="clv_underline"><img src="images/garden_underline.png" alt="image" /></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="garden_project_grid">
                    @foreach($images as $image)
                    <div class="project_item garden planting">
                        <div class="project_block">
                            <div class="project_image"><img src="{{ url("$image->image") }}" alt="image" />
                            </div>
                            <div class="project_overlay">
                                <h3>{{$image->title}}</h3>
                                <p>
                                    {{$image->caption}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!--Team-->
<div class="garden_team_wrapper clv_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="clv_heading">
                    <h3 class="text-white">تیم ما</h3>
                    <div class="clv_underline"><img src="images/underline2.png" alt="image" /></div>
                    <p class="text-white">
                        آدم های خوب با مهارت فراوان
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <div class="shop_slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper pb-2">
                            @foreach($employees as $employee)
                            <div class="swiper-slide">
                                <div class="shop_slide">
                                    <div class="garden_team_block">
                                        <img src="{{ url("$employee->image") }}" class="img-fluid" alt="image" />
                                        <div class="garden_team_overlay">
                                            <h3>{{ $employee->name }}</h3>
                                            <h6>{{ $employee->explanation }}</h6>
                                            <ul>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span><i class="fab fa-facebook" aria-hidden="true"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span><i class="fab fa-twitter" aria-hidden="true"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span><i class="fab fa-linkedin" aria-hidden="true"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span><i class="fab fa-instagram" aria-hidden="true"></i></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <span class="slider_arrow partner_left left_arrow">

                    </span>
                    <span class="slider_arrow partner_right right_arrow">

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Partner-->
<div class="clv_partner_wrapper clv_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="partner_slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($partners as $partner)
                            <div class="swiper-slide">
                                <div class="partner_slide">
                                    <div class="partner_image">
                                        <img src="{{ url("$partner->image") }}" alt="image" class="img-fluid"
                                            style="height: 64px" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <span class="slider_arrow partner_left left_arrow">

                    </span>
                    <span class="slider_arrow partner_right right_arrow">

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
   
@include('includes.contact-us')
@endsection