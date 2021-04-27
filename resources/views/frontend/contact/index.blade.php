@extends('layouts.app_frontend')
@section('title', 'Liên hệ')
@section('content')
    <div class="container">
        @if($slide)
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style ="background: url('{{pare_url_file($slide->s_banner)}}')">
            <div class="container py-5">
                <div class="row px-4 px-lg-5">
                    <div class="col-lg-6">
                        <p class="text-muted small text-uppercase mb-2">{{ $slide->s_description }}</p>
                        <h1 class="h2 text-uppercase mb-3">{{ $slide->s_title }}</h1>
                        <a class="btn btn-dark" href="{{ $slide->s_link}}">{{ $slide->s_text}}</a>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
            <header class="text-center">
                <h2 class="h5 text-uppercase mb-4">Liên hệ với chúng tôi</h2>
            </header>
        </section>
        <div class="row">
            <div class="col-md-12">
                <h4>Thông tin liên hệ</h4>
                <p>Địa chỉ: Số 78, đường Quốc lộ 3, thôn Phù Mã, xã Phù Linh, huyện Sóc Sơn, TP. Hà Nội</p>
                <p>Số điện thoại: 0971459902</p>
                <p>Fanpage: <a target="blank" href="https://www.facebook.com/maytinhtccservis/">Máy tính Trường Chinh 78 Phố Mã, Sóc Sơn</a>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="1wQyBXcj"></script>
                    <div class="fb-page" data-href="https://www.facebook.com/maytinhtccservis/" data-tabs="timeline" data-width="500" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/maytinhtccservis/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/maytinhtccservis/">Máy tính Trường Chinh 78 Phố Mã, Sóc Sơn</a></blockquote>
                    </div>
                </p>
            </div>
            <div class="col-md-12 mb-5">
                <h4>Bản đồ</h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5106.334674348602!2d105.85142105893215!3d21.268368475269394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31350340b4004a67%3A0x65e1b353ec3fa76b!2zNzggUUwzLCBQaMO5IExpbmgsIFPDs2MgU8ahbiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1619063170067!5m2!1svi!2s" 
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
@stop