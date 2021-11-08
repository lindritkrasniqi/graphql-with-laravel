<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Password;

class ResetPassword
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $status = Password::reset($args, function ($user, $password) {
            $user->forceFill(['password' => bcrypt($password)])->save();
        });

        return $status === Password::PASSWORD_RESET ? ['message' => trans('passwords.reset')] : new Error(trans('passwords.token'));
    }
}
