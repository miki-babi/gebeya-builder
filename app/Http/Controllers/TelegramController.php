<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    //
    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        // Log the incoming request data for debugging
        Log::info('Telegram Webhook Data:', $data);

        $chatId = $data['message']['chat']['id'] ?? null;
        $text = strtolower($data['message']['text'] ?? '');

        if ($chatId && in_array($text, ['/start', '/hello'])) {
            $reply = "Hello!";
            
            Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $chatId,
                'text' => $reply
            ]);
        }

        return response('OK', 200);
    }
}
