<?php
namespace App\Auth;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Contracts\Hashing\Hasher;

class CustomPasswordBrokerManager extends PasswordBrokerManager
{
    protected function resolve($name)
    {
        $config = $this->app['config']["auth.passwords.{$name}"];

        return new CustomPasswordBroker(
            $this->createTokenRepository(
                $this->app['db']->connection($config['connection'] ?? null),
                $this->app['hash'],
                $config['table'],
                $config['expire']
            )
        );
    }

    protected function createTokenRepository($connection, Hasher $hash, $table, $expire)
    {
        return new DatabaseTokenRepository(
            $connection,
            $hash,
            $table,
            $expire
        );
    }
}


