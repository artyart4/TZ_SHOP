<?php

namespace Tests\RequestFactories;

use Domain\src\Domain\Auth\Models\User;
use Worksome\RequestFactories\RequestFactory;

class SignInFormRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
           'email' => User::query()->inRandomOrder()->value('email'),
            'password'=>User::query()->inRandomOrder()->value('password'),
        ];
    }
}
