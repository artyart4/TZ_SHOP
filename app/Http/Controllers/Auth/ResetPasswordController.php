<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;


class  ResetPasswordController extends Controller
{
    public function page()
    {
        return view('auth.reset-password');
//        return view('auth.index');
    }

    public function handle(SignInFormRequest $request):RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        //todo flash уведомления

        return $status === Password::RESET_LINK_SENT ? back()->with(['message'=>__($status)]) : back()->withErrors(['email'=>__($status)]);
    }


}
