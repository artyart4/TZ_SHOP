<?php
declare(strict_types=1);

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use GuzzleHttp\Psr7\Response;
class TelegramLoggingHandler extends AbstractProcessingHandler
{
    protected int $chatId;
    protected string $token;
    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
        $this->chatId = $config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(array $record): void
    {
      $result =   TelegramBotApi::sendMessage($this->token, $this->chatId,$record['formatted']);
    }
}

