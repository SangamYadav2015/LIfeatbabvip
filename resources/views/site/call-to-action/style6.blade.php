@php
  $decodeData=decodeData($page_data);
@endphp
<section class="video-promo-with-icon">
            <div class="container">
                <div class="video-bg-with-icon" style="background: url('{{ asset("storage/uploads/".$decodeData['banner_bg_image']) }}')no-repeat center center / cover">
                    <a href="{{ $decodeData['video_url'] }}" class="popup-youtube"><i class="fas fa-play"></i></a>
                </div>
            </div>
            @if($decodeData['step_data'])

            <div class="video-promo-icon-wrapper bg-light-subtle pt-80 pb-120">
                <div class="container">
                    <div class="row">
                    @foreach ($decodeData['step_data'] as $step)
                        <div class="col-lg-3 col-xl-3 col-md-6 mt-4 mt-md-4 mt-lg-0">
                            <div class="single-icon-box p-0 p-lg-4">
                                <i class="fas fa-code icon-one"></i>
                                <h5 class="h6"></h5>
                                <p style="margin-top: 55px;">{{ $step['step_title'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </section>