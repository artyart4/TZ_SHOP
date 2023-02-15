<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class  SignInController extends Controller
{
    public function page()
    {
 return \view('auth.index');
//        return view('auth.index');
    }

    public function handle(SignInFormRequest $request):RedirectResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return redirect('/');
    }

    public function logOut() : RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerate();
        return redirect()->route('home');
    }
}
