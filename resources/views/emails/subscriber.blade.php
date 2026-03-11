@extends('emails.layouts.email')

@section('title', 'Subscribe NewsLetter')
<div class="email-wrapper">
<div class="email-container">
<div class="header">
    <img src="{{ asset('admin/images/BABVIPLOGO.png') }}" alt="Logo" class="logo">
    <h1>Thank You For Subscribe  Us!</h1>
</div>
<div class="email-body">
     <div class="content">
            <p>Hi {{ $email }},</p>
            <p>We're excited to bring you the latest updates and exclusive offers.</p>
            <!-- <p class="highlight-text">Limited-time offer: Get 20% off your next purchase!</p> -->
            <a href="{{ url('contact-us') }}" class="cta-button">Contact Now</a>
            <!-- <p>If you have any questions, feel free to <a href="mailto:support@babvip.com">mail us</a>.</p> -->
        </div>
</div>
<div class="social-media">
        <p>Follow us on social media:</p>
        <a href="https://www.facebook.com/babvipcreations" target="_blank">
            <i class="material-icons">facebook</i>
        </a>
        <a href="https://www.instagram.com/babvipcreations/" target="_blank">
            <i class="material-icons">instagram</i>
        </a>
        <a href="https://www.linkedin.com/company/babvipcreations" target="_blank">
            <i class="material-icons">linkedin</i>
        </a>
    </div>

<!-- Footer Section -->
<div class="footer">
    <p>© 2024 Babvip Softwares. All rights reserved.</p>
    <p>Sahastradhara Road, Dehradun, UK 248001 , INDIA <a href="#">Unsubscribe</a></p>
</div>
</div>
</div>