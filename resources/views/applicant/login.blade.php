<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--twitter og-->
    <meta name="twitter:site" content="@themetags">
    <meta name="twitter:creator" content="@themetags">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Quiety - Creative SAAS Technology & IT Solutions Bootstrap 5 HTML Template">
    <meta name="twitter:description" content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta name="twitter:image" content="#">

    <!--facebook og-->
    <meta property="og:url" content="#">
    <meta name="twitter:title" content="Quiety - Creative SAAS Technology & IT Solutions Bootstrap 5 HTML Template">
    <meta property="og:description" content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta property="og:image" content="#">
    <meta property="og:image:secure_url" content="#">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!--meta-->
    <meta name="description" content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta name="author" content="ThemeTags">

    <!--favicon icon-->
    <link rel="icon" href="{{asset('site/assets/img/favicon.png')}}" type="image/png" sizes="16x16">

    <!--title-->
    <title>Login - Babvip Career</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <!-- Font -->

    <!--build:css-->
    <link rel="stylesheet" href="{{asset('site/assets/css/main.css')}}">
    <!-- endbuild -->

    <!--custom css start-->
    <link rel="stylesheet" href="{{asset('site/assets/css/custom.css')}}">
    <!--custom css end-->

</head>

<body>

    <!--preloader start-->
    <div id="preloader" class="bg-light-subtle">
        <div class="preloader-wrap">
            <img src="{{asset('site/assets/img/favicon.png')}}" alt="logo" class="img-fluid preloader-icon">
            <div class="loading-bar"></div>
        </div>
    </div>
    <!--preloader end-->
    <!--main content wrapper start-->
    <div class="main-wrapper">

        <!--register section start-->
        <section class="sign-up-in-section bg-dark ptb-60" style="background: url('assets/img/page-header-bg.svg')no-repeat right bottom">
            
            <div class="container">
                <div class="row justify-content-center">
                @foreach ($careerSettings as $setting)
                    <div class="col-lg-10 col-12">
                        <div class="pricing-content-wrap bg-custom-light rounded-custom shadow-lg">
                            <div class="price-feature-col pricing-feature-info text-white left-radius p-5 order-1 order-lg-0">
                                <a href="{{url('/')}}" class="mb-5 d-none d-xl-block d-lg-block"><img src="{{asset('site/assets/img/logo resize.png')}}" alt="logo" class="img-fluid"></a>
                                <div class="customer-testimonial-wrap mt-60">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="testimonial-tab-1" role="tabpanel">
                                            <div class="testimonial-tab-content mb-4">
                                                <div class="mb-2">
                                                    <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                    </ul>
                                                </div>
                                                <blockquote>
                                               
                                  
                                                    <h5>{{$setting->title}}</h5>
                                                    {{$setting->subtitle}}
                                                   
                                                </blockquote>
                                                <div class="author-info mt-4">
                                                    <h6 class="mb-0">{{$setting->name}}</h6>
                                                    <span>{{$setting->designation}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="testimonial-tab-2" role="tabpanel">
                                            <div class="testimonial-tab-content mb-4">
                                                <div class="mb-2">
                                                    <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                    </ul>
                                                </div>
                                                <blockquote>
                                                    <h5>Amazing Quiety template!</h5>
                                                    Distinctively engineer client-centered information and cooperative core
                                                    competencies. Progressively customize client-centered repurpose viral
                                                    e-services whereas before 24/7 total linkage.
                                                </blockquote>
                                                <div class="author-info mt-4">
                                                    <h6 class="mb-0">Oberoi R.</h6>
                                                    <span class="small">CEO at Herbs</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="testimonial-tab-3" role="tabpanel">
                                            <div class="testimonial-tab-content mb-4">
                                                <div class="mb-2">
                                                    <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                        <li class="list-inline-item"><i
                                                                class="fas fa-star text-warning"></i></li>
                                                    </ul>
                                                </div>
                                                <blockquote>
                                                    <h5>Embarrassed by the First Version!</h5>
                                                    Efficiently whiteboard cross-unit meta-services after bleeding-edge
                                                    deliverables. Quickly transition standardized schemas via leveraged
                                                    users. Assertively actualize mission-critical supply chains through .
                                                </blockquote>
                                                <div class="author-info mt-4">
                                                    <h6 class="mb-0">Joan Dho</h6>
                                                    <span class="small">Founder and CTO</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav testimonial-tab-list mt-5" id="nav-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="active" href="#testimonial-tab-1" data-bs-toggle="tab" data-bs-target="#testimonial-tab-1" role="tab" aria-selected="true">
                                                <img src="{{asset('site/assets/img/testimonial/1.jpg')}}" class="img-fluid rounded-circle" width="60" alt="user">
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#testimonial-tab-2" data-bs-toggle="tab" data-bs-target="#testimonial-tab-2" role="tab" aria-selected="false">
                                                <img src="{{asset('site/assets/img/testimonial/2.jpg')}}" class="img-fluid rounded-circle" width="60" alt="user">
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#testimonial-tab-3" data-bs-toggle="tab" data-bs-target="#testimonial-tab-3" role="tab" aria-selected="false">
                                                <img src="{{asset('site/assets/img/testimonial/3.jpg')}}" class="img-fluid rounded-circle" width="60" alt="user">
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="row justify-content-center mt-60">
                                    <div class="col-12">
                                        <p>{{$setting->base_heading}}</p>
                                        <ul class="list-unstyled list-inline mb-0">
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-1.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-2.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-3.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-4.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-5.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                            <li class="list-inline-item">
                                                <img src="{{asset('site/assets/img/clients/client-logo-6.svg')}}" width="120" alt="clients logo" class="img-fluid py-3 me-3 customer-logo">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="price-feature-col pricing-action-info p-5 right-radius bg-light-subtle order-0 order-lg-1">
                                <a href="index.html" class="mb-5 d-block d-xl-none d-lg-none"><img src="assets/img/logo-color.png" alt="logo" class="img-fluid"></a>
                                <h1 class="h3">Login Here</h1>
                                <p class="text-muted">Login here and start your journey with us.</p>

                                 
           

               <form action="{{ route('applicant.login') }}" class="mt-4 register-form" method="POST">
               @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="email" class="mb-1">Email <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input name="email" type="email" class="form-control" placeholder="Email" id="email" required aria-label="email">
                                        </div>
                                        
                                             @error('email')

                                                <small class="text-danger">{{ $message }}</small>

                                            @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="password" class="mb-1">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input name="password" type="password" class="form-control" placeholder="Password" id="password" required aria-label="Password">
                                        </div>
                                        @error('password')

                                                <small class="text-danger">{{ $message }}</small>

                                            @enderror
                                         <div class="text-end mb-3">
                                            <a href="{{ route('applicant.password.request')}}" class="text-decoration-none text-primary fw-semibold" style="font-size: 0.9rem;">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-3 d-block w-100">Submit</button>
                                        
                                    </div>
                                    <div class="col-12">
                                    <p class="font-monospace fw-medium text-center text-muted mt-3 pt-4 mb-0">Don’t have an
                                    account? <a href="{{route('applicant.register')}}" class="text-decoration-none">Sign up</a>
                                        </p>
                                        </div>
                                </div>
                                

                                 

                                
                            </form>
                           
                        
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>
        <!--register section end-->

    </div>
    <!--main content wrapper end-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('account_suspended'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Account Suspended',
        text: '{{ session('account_suspended') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif

    <!--build:js-->
    <script src="{{asset('site/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/parallax.min.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/aos.js')}}"></script>
    <script src="{{asset('site/assets/js/vendors/massonry.min.js')}}"></script>
    <script src="{{asset('site/assets/js/app.js')}}"></script>
    <!--endbuild-->
</body>

</html>