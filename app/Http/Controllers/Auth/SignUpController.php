<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use Domain\src\Domain\Auth\Providers\Contracts\RegisterNewUserContract;
use Illuminate\Http\RedirectResponse;


class  SignUpController extends Controller
{
    public function page()
    {
        return view('auth.sign-up');
    }


    public function handle(SignUpFormRequest $request, RegisterNewUserContract $action):RedirectResponse
    {
        //todo DTOs
        $action($request->validated(['name'=>'','email'=>'','password'=>'']));
     return redirect(route('home'));
    }

}
