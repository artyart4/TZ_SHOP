<?php
declare(strict_types=1);

namespace Domain\src\Domain\Auth\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class AuthRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{
    \Illuminate\Support\Facades\Route::middleware('web')->group(function (){
        Route::get('/login',[SignInController::class,'page'])->name('login');
        Route::post('/login',[SignInController::class,'handle'])->name('signIn');
        Route::get('/sign-up',[SignUpController::class,'page'])->name('signUp');
        Route::post('/sign-up',[SignUpController::class,'handle'])->name('store');
        Route::delete('/logout',[SignInController::class,'logOut'])->name('logOut');

        Route::get('/forgot-password',[ForgotPasswordController::class,'page'])->name('password.request');
        Route::post('/forgot-password',[ForgotPasswordController::class,'handle'])->name('password.email');

        Route::get('/reset-password/{token}',[ResetPasswordController::class,'page'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class,'handle'])->name('password.update');

        Route::get('/auth/redirect/{driver}', [SocialAuthController::class,'redirect'])->name('socialite.redirect');

        Route::get('/github/{driver}callback', [SocialAuthController::class,'handle'])->name('socialite.github');
    });
}
}
