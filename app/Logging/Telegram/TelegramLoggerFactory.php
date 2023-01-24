<?php
declare(strict_types=1);

namespace App\Logging\Telegram;
use Monolog\Logger; // на основе этой библиотеки будем логировать

class TelegramLoggerFactory
{
   public function __invoke(array $config):Logger
   {
       $logger = new Logger('telegram');
       $logger->pushHandler(new TelegramLoggingHandler($config));
       return $logger;
   }
}

