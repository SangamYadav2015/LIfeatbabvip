@php
$decodeData=decodeData($page_data);
@endphp

<section class="contact-us ptb-120 position-relative overflow-hidden">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="section-heading aos-init aos-animate" data-aos="fade-up">
                            <h4 class="h5 text-primary">{{ $decodeData['sub_title'] }}</h4>
                            <h2>{{ $decodeData['title'] }}</h2>
                            <p>{{ $decodeData['description'] }} </p>
                        </div>
                        @if($decodeData['step_data'])
                        <div class="row justify-content-between pb-5">
                        @foreach ($decodeData['step_data'] as $step)
                            <div class="col-sm-6 mb-4 mb-md-0 mb-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">
                                <div class="icon-box d-inline-block rounded-circle">
                                <img src="{{ asset("storage/uploads/".$step['step_image']) }}" class="img-fluid" alt="{{ $step['step_image_icon_alt_tag'] }}">
                                </div>
                                <div class="contact-info">
                                    <h5>{{ $step['step_title'] }}</h5>
                                    <p>{{ $step['step_description'] }}</p>
                                    @if( $step['step_link_text'] )
                                    <a href="{{ $step['step_link_url'] }}" class="read-more-link text-decoration-none">
                                        <!-- <i class="fas fa-phone me-2"></i>  -->
                                        {{ $step['step_link_text'] }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        @endif
                    </div>
                    <div class="col-xl-5 col-lg-7 col-md-12">
                        <div class="register-wrap p-5 bg-white shadow rounded-custom position-relative aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                        <form action="#" class="register-form position-relative z-5 contactForm" method="post">
                        <h3 class="mb-5 fw-medium">Fill out the form and we'll be in touch as soon as
                        possible.</h3>
                        @csrf
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="firstName" required="" placeholder="First name" aria-label="First name" name="first_name">
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last name" aria-label="Last name" name="last_name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="phone" required="" placeholder="Phone" aria-label="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" id="email" required="" placeholder="Email" aria-label="Email" name="email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="subject" required="" placeholder="Subject" aria-label="subject" name="subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="yourMessage" required="" placeholder="How can we help you?" style="height: 120px" name="message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 submitbtn">Get in Touch</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" bg-dark position-absolute bottom-0 h-25 bottom-0 left-0 right-0 z--1 py-5" style="background: url( '{{ asset("site/assets/img/shape/dot-dot-wave-shape.svg") }}' ) no-repeat center top;">
                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
                <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
            </div>
        </section>