@php
  $decodeData=decodeData($page_data);
@endphp
    <!--cat subscribe start-->
    <section class="cta-subscribe bg-dark ptb-120 position-relative overflow-hidden">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="subscribe-info-wrap text-center position-relative z-2">
                        <div class="section-heading">
                            <h4 class="h5 text-warning">{{ $decodeData['sub_title'] }}</h4>
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }}</p>
                        </div>
                        <div class="form-block-banner mw-60 m-auto mt-5">
                            <form id="email-form2" name="email-form" class="subscribe-form d-flex subscribenewsletter" method="post">
                            @csrf
                                <input type="email" class="form-control me-2" name="email" data-name="Email" placeholder="Your email" id="Email2" required="">
                                <input type="submit" value="Join!" data-wait="Please wait..." class="btn btn-primary submitbtnsubs">
                            </form>
                        </div>
                        <ul class="nav justify-content-center subscribe-feature-list mt-3">

                            @foreach ($decodeData['steps'] as $stepsclient)

                            <li class="nav-item">
                                        <span><i class="far fa-dot-circle text-primary me-2"></i>{{ $stepsclient['step_title'] }}</span>
                                    </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
            <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
        </div>
    </section>
    <!--cat subscribe end-->