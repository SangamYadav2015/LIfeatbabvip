<?php 
namespace App\Auth;

use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CustomPasswordBroker extends PasswordBroker
{
    public function createToken($user)
    {
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->getEmailForPasswordReset()],
            [
                'email' => $user->getEmailForPasswordReset(),
                'token' => $token,
                'created_at' => now(),
            ]
        );

        return $token;
    }
}
