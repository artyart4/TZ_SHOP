<?php
declare(strict_types=1);

namespace Domain\src\Services\Telegram;

use Domain\src\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    public const HOST ='https://api.telegram.org/bot';

    public static function sendMessage(string $token,int $chatId, string $text) :bool
    {
        try {
            $res =  Http::get(self::HOST . $token . '/sendMessage',['chat_id'=>$chatId,'text'=>$text])->json();
            if ($res['ok']=== true){
                return true;
            }
        }catch (\Throwable $exception){
             report(new TelegramBotApiException($exception->getMessage()));
            return false;
        }
    }
}
