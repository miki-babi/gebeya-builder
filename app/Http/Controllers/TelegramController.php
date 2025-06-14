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
        Log::info('Telegram Webhook Data: ', $data);

    $chatId = $data['message']['chat']['id'] ?? null;
    $text = strtolower($data['message']['text'] ?? '');

    // Telegram::sendMessage($chatId, $text);
    // Telegram::sendMessage('@axumverse', $text);
    // Telegram::sendDeleteMessage('@axumverse', 52);
    Telegram::copyMessage(1285282178, 52, '@axumverse');


    return response('OK', 200);
}
}
