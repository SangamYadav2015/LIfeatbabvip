@extends('site.layout.app')

@section('content')
<style>
   .text-muted {
    --bs-text-opacity: 1;
    color: #737373 !important;
    font-size: 12px;
    font-weight: 600;
}
.customh-5{    font-size: 1rem;
}
p{
    font-size: 14px;
}
.support-article-wrap ul li {
    
    font-size: 14px;
    list-style: circle;

}
</style>
<section class="support-content ptb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 d-none d-md-block d-lg-block">
                        <div class="support-article-sidebar sticky-sidebar">
                            <a href="javascript:history.back();" class="btn btn-primary mb-4 btn-sm"><i class="fas fa-angle-left me-2"></i> Go Back</a>
                            <div class="nav flex-column nav-pills support-article-tab bg-light-subtle rounded-custom p-5">
                                <h5 class="customh-5">Related Support Articles</h5>
                              @foreach ($helpRelated as $item)
                                <a href="{{ url('help/'.$item->slug)}}" class="text-muted text-decoration-none py-2 d-block">
                                   {{  $item->question }}</a>
                              @endforeach

                            </div>
                            <!-- <div class="bg-light-subtle p-5 mt-4 rounded-custom quick-support">
                                <a href="contact-us.html" class="text-decoration-none text-muted d-flex align-items-center py-2">
                                    <div class="quick-support-icon rounded-circle bg-success-soft me-3">
                                        <i class="fas fa-headset text-success"></i>
                                    </div>
                                    <div class="contact-option-text">Quick Support Form</div>
                                </a>
                                <a href="mailto:info@themetags.com" class="text-decoration-none text-muted d-flex align-items-center py-2">
                                    <div class="quick-support-icon rounded-circle bg-primary-soft me-3">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div class="contact-option-text">info@themetags.com</div>
                                </a>
                                <a href="#" target="_blank" class="text-decoration-none text-muted d-flex align-items-center py-2">
                                    <div class="quick-support-icon rounded-circle bg-danger-soft me-3">
                                        <i class="fas fa-comment text-danger"></i>
                                    </div>
                                    <div class="contact-option-text">Live Support Chat</div>
                                </a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 p-lg-5">
                        <div class="support-article-wrap">
                            <h1 class="display-5 mb-4 fw-bold">{{ $help->question }}</h1>
                            {!! $help->answer !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection