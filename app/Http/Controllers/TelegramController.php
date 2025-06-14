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

        $response = Telegram::sendInvoice(
            $chatId,
            "Test Invoice",
            "This is a test product",
            "payload_123",  // unique payload to identify this invoice
            "", // get from your .env
            "USD",
            $prices,
            ['start_parameter' => 'test-invoice'] // optional extra params
        );

        return response()->json(['sent' => true, 'response' => $response->json()]);
    }


    return response('OK', 200);
}
}
