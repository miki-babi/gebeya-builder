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
    $text = strtolower($data['message']['text'] ?? '');

    if ($chatId) {
        if ($text === '/sendphoto') {
            Telegram::sendPhoto($chatId, 'https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Here is your photo!');
        } else {
            Telegram::sendMessage($chatId, "Send /sendphoto to get an image.");
        }
    }

    return response('OK', 200);
}
}
