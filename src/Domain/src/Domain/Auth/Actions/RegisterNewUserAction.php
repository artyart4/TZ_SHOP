<?php
declare(strict_types=1);

namespace Domain\src\Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Domain\Auth\Providers\Contracts\RegisterNewUserContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(array $data):RedirectResponse
    {

        $user =   User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])
        ]);
        event(new Registered($user));
        auth()->login($user);
        return redirect(route('home'));
    }
}
