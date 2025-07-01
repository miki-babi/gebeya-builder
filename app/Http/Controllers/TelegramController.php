<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Helpers\Telegram;
use Illuminate\Support\Facades\Cache;

class TelegramController extends Controller
{
    //
    public function handleWebhook(Request $request)
{
    $data = $request->all();
    // Log::info('Telegram Webhook Data: ', $data);
if (isset($data['callback_query'])) {
    $callback = $data['callback_query'];
    $callbackQueryId = $callback['id'] ?? null;
    $user = $callback['from'] ?? [];
    $userId = $user['id'] ?? null;
    $username = $user['username'] ?? 'unknown';

    Log::info('[Telegram Callback] Received', [
        'callback_query_id' => $callbackQueryId,
        'user_id' => $userId,
        'username' => '@' . $username,
        'data' => $callback['data'] ?? 'no_data',
    ]);

    // Prevent duplicate processing (e.g., within 10 seconds)
    $cacheKey = 'telegram_callback_' . $callbackQueryId;
    if (Cache::has($cacheKey)) {
        Log::info('[Telegram Callback] Duplicate ignored: ' . $callbackQueryId);
        return;
    }
    Cache::put($cacheKey, true, 10); // Cache for 10 seconds

    // Process action here (e.g., add to cart)
    Log::info('[Telegram Callback] Processing Add to Cart for user: ' . $userId);

    // Respond with alert
    Telegram::alertCallbackQuery($callbackQueryId, '🛒 Added to cart! @' . $username, false);
}


    $chatId = $data['message']['chat']['id'] ?? null;
    $text = strtolower($data['message']['text'] ?? '');

    // if (isset($data['callback_query'])) {
    //     $callbackQueryId = $data['callback_query']['id'];
    //     $userId = $data['callback_query']['from']['id'];

    //     // Do something with $userId (e.g., add to cart)
    //     Log::info('Callback Query User ID: ' . $userId);

    //     Telegram::alertCallbackQuery($callbackQueryId, 'Added to cart! @' . $userId, true);
    // }


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
    'web_app_url' => 'https://t.me/gebeya_builderbot?startapp=adminueiowrueuerioew',
];

$photoUrl = 'https://images.pexels.com/photos/8597551/pexels-photo-8597551.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1';

// Telegram::sendProductPost('@axumverse', $photoUrl, $product);
Telegram::postWithInlineButton('@axumverse', 'Product XYZ', 'Add to Cart', 'add_to_cart_xyz');



}

    return response('OK', 200);
}

}


