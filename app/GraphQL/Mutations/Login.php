<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Auth\TokenGuard;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard("sanctum");

        if ($guard->check()) {
            return ['token' => request()->bearerToken()];
        }

        if (!Auth::attempt($args)) {
            throw new Error("Invalid credentials!");
        }

        return ['token' => $guard->user()->createToken(request()->userAgent())->plainTextToken];
    }
}
