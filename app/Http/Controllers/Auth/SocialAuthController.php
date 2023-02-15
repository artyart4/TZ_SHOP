<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Domain\src\Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;


class  SocialAuthController extends Controller
{
    public function redirect(string $driver)
    {
        try {
            return Socialite::driver($driver)->redirect();
        }catch (\Throwable $e){
         throw new \DomainException('Произошла ошибка, драйвер не поддерживается');
        }

//        return view('auth.index');
    }

    public function handle(SignInFormRequest $request, string $driver):RedirectResponse
    {
        if ($driver !=='github'){
            throw new \DomainException('Произошла ошибка, драйвер не поддерживается');
        }
        $githubUser = Socialite::driver($driver)->user();

        $user = User::where('github_id', $githubUser->id)->first();

        //todo 3rd lesson move to custom table
        if ($user) {
            $user->update([
                $driver . "_id" => $githubUser->id,
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name ?? 'user',
                'email' => $githubUser->email,
                'github_id' => $githubUser->id,
            ]);
        }

        auth()->login($user);

        return redirect('/home');
    }

}
