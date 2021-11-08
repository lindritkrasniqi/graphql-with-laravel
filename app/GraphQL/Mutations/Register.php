<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class Register
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): User
    {
        unset($args['password_confirmation']);

        return User::create($args);
    }
}
