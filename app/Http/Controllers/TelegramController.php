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

    if ($chatId && $text === '/buy') {
        $prices = [
            ['label' => 'Sample Product', 'amount' => 1000], // amount in cents
            ['label' => 'Tax', 'amount' => 100],
        ];

       $inlineKeyboard = [
    [
        ['text' => 'Visit Site', 'url' => 'https://example.com'],
        ['text' => 'Like', 'callback_data' => 'like_photo']
    ]
];

Telegram::sendPhotoWithKeyboard($chatId, 'https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Check this out!', $inlineKeyboard, true);
    }


    return response('OK', 200);
}
}
