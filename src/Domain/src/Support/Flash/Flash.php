<?php
declare(strict_types=1);

namespace Domain\src\Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'shop_flash_message';
    public const MESSAGE_CLASS = 'shop_flash_class';
public function __construct(protected Session $session)
{

}
    public function get():?FlashMessage
    {
       $message = $this->session->get(self::MESSAGE_KEY);
       if (!$message){
           return null;
       }
       return new FlashMessage($message, $this->session->get(self::MESSAGE_CLASS,''));
    }

public function info(string $message): void
{
  $this->session->flash(self::MESSAGE_KEY, $message); //это флеш сессии
    $this->session->flash(self::MESSAGE_CLASS, config('flash.info'));
}

public function alert(string $message): void
{
    $this->session->flash(self::MESSAGE_KEY, $message); //это флеш сессии
    $this->session->flash(self::MESSAGE_CLASS, config('flash.alert'));
}
}
