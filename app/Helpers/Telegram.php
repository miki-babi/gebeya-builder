<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class Telegram
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function sendMessage($chatId, $reply)
    {
        return Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
            'chat_id' => $chatId,
            'text' => $reply,
        ]);
    }
}
