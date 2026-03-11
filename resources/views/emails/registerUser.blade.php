@extends('emails.layouts.email')

@section('title', 'Contact Us Message')
<div class="email-wrapper">
<div class="email-container">
<div class="header">
    <img src="{{ asset('admin/images/BABVIPLOGO.png') }}" alt="Logo" class="logo">
    <h1>User Account Created Successfully!</h1>
</div>
<div class="email-body">
    <p>Dear {{ $name }} ,</p>
    <p>Your Account Created Successfully knidly check your login details given below</p>
    <p><strong>Login Link:</strong> <a href="{{ url('/admin/login') }}" target="_blank">Click here to login</a></p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
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