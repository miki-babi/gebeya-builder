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

    if (!$chatId) {
        return response('No chat ID', 400);
    }

    // Check if text starts with /start startapp=
    if (str_starts_with($text, '/start startapp=')) {
        $param = substr($text, strlen('/start startapp='));
        // Send mini app button to the user
        Telegram::sendMiniAppButton(
            $chatId,
            "Launching your app...",
            "Open App",
            "https://your-mini-app-url.com/"
        );
    } else {
        // Default response or ignore
        // Telegram::sendMessageWithUrlButton(
        //     '@axumverse',
        //     'Welcome! Check out our store.',
        //     'Open Store',
        //     'https://t.me/gebeya_builderbot?startapp=store',
        // );
        $product = [
    'name' => 'Green T-Shirt',
    'description' => 'Comfortable cotton t-shirt',
    'category' => ['Clothing'],
    'web_app_url' => 'https://t.me/gebeya_builderbot?startapp=store',
];

$photoUrl = 'https://images.pexels.com/photos/8597551/pexels-photo-8597551.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1';

Telegram::sendProductPost('@axumverse', $photoUrl, $product);

}

    return response('OK', 200);
}

}


