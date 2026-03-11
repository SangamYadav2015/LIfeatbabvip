<?php
namespace App\Services;

use ReCaptcha\ReCaptcha;

class RecaptchaService
{
    protected $recaptcha;

    public function __construct()
    {
        $this->recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
    }

    public function verify($token, $ip)
    {
        return $this->recaptcha->verify($token, $ip);
    }
}
