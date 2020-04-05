@extends('template')

@section('title')
    iraniancollege - Learning Machine Flan
@endsection

@section('style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/main.css') }}" >
@endsection

@section('content')
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="jumbotron jumbotron-fluid bg-transparent">
                <div class="container text-gold">
                    <h1 class="display-4">درباره ما</h1>
                    <p class="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و به پایان رسد وزمان مورد نیاز مورد استفاده قرار گیرد.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
