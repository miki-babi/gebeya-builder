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

    $chatId = $data['message']['chat']['id'] ?? null;

    if ($chatId) {
        // Show "typing..." action in the chat for 5 seconds
        Telegram::sendChatAction($chatId, 'typing');

        // Then send a message after a short delay (simulate processing)
        sleep(2);

        Telegram::sendMessage($chatId, "Hello! I'm typing like a human 😄");
    }

    return response('OK', 200);
    }
}
