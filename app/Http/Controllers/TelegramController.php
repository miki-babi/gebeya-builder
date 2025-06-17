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
    'category' => 'Clothing',
    'web_app_url' => 'https://yourdomain.com/store',
];

$photoUrls = [
    'https://yourdomain.com/images/shirt1.jpg',
    'https://yourdomain.com/images/shirt2.jpg',
];

Telegram::sendProductPost($chatId, $photoUrls, $product);

    }

    return response('OK', 200);
}

}