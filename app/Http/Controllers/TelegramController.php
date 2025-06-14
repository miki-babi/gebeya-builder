<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Helpers\Telegram;

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

            Telegram::sendMessage($chatId, $reply);
        }

        return response('OK', 200);
    }
}
