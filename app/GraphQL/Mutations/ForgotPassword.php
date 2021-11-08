<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Password;

class ForgotPassword
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $status = Password::sendResetLink($args);

        return $status === Password::RESET_LINK_SENT ? ['message' => trans('passwords.sent')] : new Error($status);
    }
}
