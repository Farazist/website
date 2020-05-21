<div class="clv_section mb-5" id="section-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-white">
                <p>
                    هفت روز هفته ، ۲۴ ساعت شبانه‌روز پاسخگوی شما هستیم
                </p>
                <h4 class="mt-4">
                    <span class="fad fa-phone fa-fw fa-lg"></span>
                    05135420483
                </h4>
                <h4 class="mt-4">
                    <span class="fad fa-sms fa-fw fa-lg"></span>
                    09152525180 - 09152163545
                </h4>
                <h4 class="mt-4">
                    <span class="fad fa-at fa-fw fa-lg"></span>
                    info@farazist.ir
                </h4>
                <h4 class="mt-4">
                    <span class="fad fa-map-marker-alt fa-fw fa-lg"></span>
                    مشهد - بزرگراه آسیایی - ابتدای شهرک صنعتی توس - شرکت اقتصاد سبز فرامرزی
                </h4>
            </div>
            <div class="col-lg-5">
                <form method="POST" action="{{ url("/send-message") }}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control rounded-pill" name="name" placeholder="نام">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control rounded-pill" name="mobile_number"
                                placeholder="شماره همراه">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea style="border-radius: 20px" class="form-control" name="text" placeholder="پیام"
                            rows="4"></textarea>
                    </div>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="recaptcha" id="recaptcha" type="hidden">
                    <button type="submit" class="btn btn-light btn-block rounded-pill">بفرست</button>
                </form>
            </div>
            <div class="col-lg-1 justify-content-center pt-3">
                <a target="_blank" href="https://trustseal.enamad.ir/?id=148613&amp;Code=rh2YPKTGiIJORKMYsQSp">
                    <img src="https://Trustseal.eNamad.ir/logo.aspx?id=148613&amp;Code=rh2YPKTGiIJORKMYsQSp" alt=""
                        style="cursor:pointer" id="rh2YPKTGiIJORKMYsQSp">
                </a>
            </div>
        </div>
        <br>
        <p class="text-center text-white">
            با ما همراه بشین
        </p>
        <ul class="list-inline mb-0 text-center">
            @foreach($social_networks as $social_network)
            <li class="list-inline-item">
                <a class="text-white" href="{{ $social_network->link }}" data-toggle="tooltip" data-placement="bottom"
                    title="{{ $social_network->description }}">
                    <i class="{{ $social_network->icon }} fa-2x fa-fw"></i>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>