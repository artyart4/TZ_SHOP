<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use Illuminate\Http\RedirectResponse;
use vendor\src\Domain\Auth\Providers\Contracts\RegisterNewUserContract;


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
