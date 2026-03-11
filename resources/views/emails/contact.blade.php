@extends('emails.layouts.email')

@section('title', 'Contact Us Message')
<div class="email-wrapper">
<div class="email-container">
<div class="header">
    <img src="{{ asset('admin/images/BABVIPLOGO.png') }}" alt="Logo" class="logo">
    <h1>Thank You For Contact Us!</h1>
</div>
<div class="email-body">
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>phone:</strong> {{ $phone }}</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $messageContent }}</p>
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