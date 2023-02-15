<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use vendor\src\Domain\Auth\Models\User;


class  Controller extends Controller
{








    public function reset($token): View
    {
        return view('auth.reset-password', ['token'=>$token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('message', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('github_id', $githubUser->id)->first();

        //todo 3rd lesson move to custom table
        if ($user) {
            $user->update([
                'github_id' => $githubUser->id,
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name ?? 'user',
                'email' => $githubUser->email,
                'github_id' => $githubUser->id,
            ]);
        }

        auth()->login($user);

        return redirect('/');
    }

}
