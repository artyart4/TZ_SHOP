<?php
declare(strict_types=1);

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

final class TelegramBotApi
{
    public const HOST ='https://api.telegram.org/bot';

    public static function sendMessage(string $token,int $chatId, string $text) :bool
    {
       $res =  Http::get(self::HOST . $token . '/sendMessage',['chat_id'=>$chatId,'text'=>$text])->json();
       if ($res['ok']!== true){
         return false;
       }return true;
    }
}
