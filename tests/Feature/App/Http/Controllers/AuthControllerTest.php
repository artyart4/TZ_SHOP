<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpFormRequest;
use App\Listeners\SendEmailNewUserListener;
use App\Notifications\SendEmailNewUserNotification;
use Database\Factories\UserFactory;
use Domain\src\Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *@test
     * @return void
     */



    public function test_is_login_page_success():void
    {
        $this->get(route('login'))->assertOk()->assertSee('login')->assertViewIs('auth.index');
    }

    public function test_it_sign_in_success():void
    {
        $user =UserFactory::new()->create(['name'=>'alex','email'=>'jojoss@gm.com','password'=>bcrypt('12345678q')]);

        $request = SignInFormRequest::factory()->create(['password'=>'12345678q','email'=>$user->email]);
        $response = $this->post(route('signIn'),$request);
        $response->assertValid()->assertRedirect('/');
//        $this->assertAuthenticatedAs($user);
    }

    public function test_is_signUp_page_success():void
    {
        $this->get(route('signUp'))->assertOk()->assertSee('регистрация')->assertViewIs('auth.sign-up');
    }

    public function test_it_store_success():void
    {
       Notification::fake();
       Event::fake();
    $response = $this->get(route('home'));

       $request = SignUpFormRequest::factory()->create(['name'=>'jopojop','password'=>'12345678q','password_confirmation'=>'12345678q']); //input
       $response = $this->post(route('store'), $request);//ok не ok
        $response->assertValid();
//       $this->assertDatabaseHas('users',['email'=>$request['email']]);
        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class,SendEmailNewUserListener::class);

        $user = User::query()->where('email', $request['email'])->first();

        $event = new Registered($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);
        Notification::assertSentTo($user,SendEmailNewUserNotification::class);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));

    }

    public function test_it_logout_success():void
    {
        $this->get('/');
        $user = UserFactory::new()->create(['name'=>'alex','email'=>'jofjo@gm.com','password'=>bcrypt('12345678q')]);
        $this->actingAs($user)->delete(route('logOut'));
        $this->assertGuest();

    }
    //Todo тесты по восстановлению паролей и тесты по гитхабу
    //todo создать тесты по их локализации
}
