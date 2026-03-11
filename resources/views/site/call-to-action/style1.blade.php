@php
  $decodeData=decodeData($page_data);
@endphp
<style>
    .software-uikit {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    background-position: 50px 100px !important;
    background-size: cover !important;
    background-repeat: no-repeat !important;
}
</style>
<div class="style-guide">
            <!-- <div class="bg-primary-soft ptb-60">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="style-guide-heading text-center">
                                <h2>Call to Action with Features</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!--cta with feature start-->
            <section class="cta-with-feature ptb-120">
                <div class="container">
                    <div class="bg-dark text-white rounded-custom position-relative">
                        <div class="row">
                            <div class="col-lg-7 col-md-10">
                                <div class="cta-with-feature-wrap p-5">
                                    <h2>{{ $decodeData['title'] }}</h2>
                                    <ul class="cta-feature-list list-unstyled d-flex flex-wrap list-two-col mb-0 mt-3">
                                    @foreach ($decodeData['steps'] as $stepsclient)
   
                                      <li class="d-flex align-items-center py-1"><i
                                                class="fas fa-check-circle me-2 text-warning"></i> {{ $stepsclient['step_title']}}
                                        </li>
                                      @endforeach
                                    </ul>
                                    <div class="action-btns mt-5">
                                        <a href="{{ $decodeData['button_url1'] }}" class="btn btn-primary me-3">{{ $decodeData['button_text1'] }}</a>
                                        <a href="{{ $decodeData['button_url2'] }}" class="btn btn-primary">{{ $decodeData['button_text2'] }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <img src="{{ asset('site/assets/img/shape/dot-shape-color.svg') }}" alt="" class="dot-shape-img position-absolute z-1 pt-5 img-fluid">
                                <div class="shape-img position-absolute d-none d-lg-block top--40 right--40">
                                    <img src="{{ asset('site/assets/img/shape/paper-plane.png') }}" alt="paper-plane">
                                </div>
                                <div class="software-uikit h-100 z-2 position-relative" style="background: url('{{ asset("storage/uploads/".$decodeData["image"]) }}')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--cta with subscribe end-->

        </div>