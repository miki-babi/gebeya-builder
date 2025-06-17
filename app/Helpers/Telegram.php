<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class Telegram
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * methods to interact with Telegram Bot API
     */
    protected static function baseUrl()
    {
        return 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/';
    }

    public static function sendMessage($chatId, $text, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendMessage', array_merge([
            'chat_id' => $chatId,
            'text'    => $text,
        ], $extra));
    }

    public static function sendPhoto($chatId, $photoUrl, $caption = '', $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendPhoto', array_merge([
            'chat_id' => $chatId,
            'photo'   => $photoUrl,
            'caption' => $caption,
        ], $extra));
    }

    public static function sendDocument($chatId, $documentUrl, $caption = '', $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendDocument', array_merge([
            'chat_id' => $chatId,
            'document' => $documentUrl,
            'caption' => $caption,
        ], $extra));
    }

    public static function sendSticker($chatId, $stickerFileId, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendSticker', array_merge([
            'chat_id' => $chatId,
            'sticker' => $stickerFileId,
        ], $extra));
    }

    public static function sendAudio($chatId, $audioUrl, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendAudio', array_merge([
            'chat_id' => $chatId,
            'audio' => $audioUrl,
        ], $extra));
    }

    public static function sendVideo($chatId, $videoUrl, $caption = '', $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendVideo', array_merge([
            'chat_id' => $chatId,
            'video' => $videoUrl,
            'caption' => $caption,
        ], $extra));
    }

    public static function answerCallbackQuery($callbackQueryId, $text = '', $showAlert = false)
    {
        return Http::post(self::baseUrl() . 'answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    public static function getUpdates($offset = null, $limit = 100, $timeout = 0)
    {
        return Http::post(self::baseUrl() . 'getUpdates', [
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
        ]);
    }
    public static function editMessageText($chatId, $messageId, $text, $extra = [])
    {
        return Http::post(self::baseUrl() . 'editMessageText', array_merge([
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
        ], $extra));
    }
    public static function sendDeleteMessage($chatId, $messageId, $extra = [])
    {
        return Http::post(self::baseUrl() . 'deleteMessage', array_merge([
            'chat_id' => $chatId,
            'message_id' => $messageId,
        ], $extra));
    }

    public static function copyMessage($fromChatId, $messageId, $targetChatId)
{
    return Http::post(self::baseUrl() . 'copyMessage', [
        'from_chat_id' => $fromChatId,
        'message_id' => $messageId,
        'chat_id' => $targetChatId
    ]);
}


    public static function deleteMessage($chatId, $messageId)
    {
        return Http::post(self::baseUrl() . 'deleteMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
        ]);
    }

    public static function forwardMessage($chatId, $fromChatId, $messageId)
    {
        return Http::post(self::baseUrl() . 'forwardMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'message_id' => $messageId,
        ]);
    }

    public static function kickChatMember($chatId, $userId, $untilDate = null)
    {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ];

        if ($untilDate) {
            $params['until_date'] = $untilDate;
        }

        return Http::post(self::baseUrl() . 'kickChatMember', $params);
    }

    public static function unbanChatMember($chatId, $userId)
    {
        return Http::post(self::baseUrl() . 'unbanChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ]);
    }

    public static function getChat($chatId)
    {
        return Http::post(self::baseUrl() . 'getChat', [
            'chat_id' => $chatId,
        ]);
    }

    public static function getChatAdministrators($chatId)
    {
        return Http::post(self::baseUrl() . 'getChatAdministrators', [
            'chat_id' => $chatId,
        ]);
    }

    public static function getChatMember($chatId, $userId)
    {
        return Http::post(self::baseUrl() . 'getChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ]);
    }

    public static function sendChatAction($chatId, $action)
    {
        // action example: 'typing', 'upload_photo', 'record_video', etc.
        return Http::post(self::baseUrl() . 'sendChatAction', [
            'chat_id' => $chatId,
            'action' => $action,
        ]);
    }

    public static function sendPhotoWithKeyboard($chatId, $photoUrl, $caption = '', $keyboard = [], $inline = false)
{
    $replyMarkup = $inline
        ? json_encode(['inline_keyboard' => $keyboard])
        : json_encode(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true]);

    return Http::post(self::baseUrl() . 'sendPhoto', [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
        'reply_markup' => $replyMarkup,
    ]);
}
    public static function sendMessageWithKeyboard($chatId, $text, $keyboard = [], $inline = false)
    {
        $replyMarkup = $inline
            ? json_encode(['inline_keyboard' => $keyboard])
            : json_encode(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true]);

        return Http::post(self::baseUrl() . 'sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'reply_markup' => $replyMarkup,
        ]);
    }
    public static function editMessageReplyMarkup($chatId, $messageId, $keyboard = [], $inline = false)
    {
        $replyMarkup = $inline
            ? json_encode(['inline_keyboard' => $keyboard])
            : json_encode(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true]);

        return Http::post(self::baseUrl() . 'editMessageReplyMarkup', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'reply_markup' => $replyMarkup,
        ]);
    }
    public static function sendLocation($chatId, $latitude, $longitude, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendLocation', array_merge([
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ], $extra));
    }
    public static function sendVenue($chatId, $latitude, $longitude, $title, $address, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendVenue', array_merge([
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
        ], $extra));
    }
    public static function sendPoll($chatId, $question, $options, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendPoll', array_merge([
            'chat_id' => $chatId,
            'question' => $question,
            'options' => json_encode($options),
        ], $extra));
    }
    public static function stopPoll($chatId, $messageId, $extra = [])
    {
        return Http::post(self::baseUrl() . 'stopPoll', array_merge([
            'chat_id' => $chatId,
            'message_id' => $messageId,
        ], $extra));
    }
    public static function sendDice($chatId, $extra = [])
    {
        return Http::post(self::baseUrl() . 'sendDice', array_merge([
            'chat_id' => $chatId,
        ], $extra));
    }
    public static function setWebhook($url, $extra = [])
    {
        return Http::post(self::baseUrl() . 'setWebhook', array_merge([
            'url' => $url,
        ], $extra));
    }
    public static function deleteWebhook($extra = [])
    {
        return Http::post(self::baseUrl() . 'deleteWebhook', $extra);
    }
    public static function sendMiniAppButton($chatId, $text, $buttonText, $webAppUrl)
{
    return Http::post(self::baseUrl() . 'sendMessage', [
        'chat_id' => $chatId,
        'text' => $text,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => $buttonText,
                        'web_app' => ['url' => $webAppUrl]
                    ]
                ]
            ]
        ])
    ]);
}

public static function sendMessageWithUrlButton($chatId, $text, $buttonText, $buttonUrl)
{
    return Http::post(self::baseUrl() . 'sendMessage', [
        'chat_id' => $chatId, // e.g. '@yourchannel' or numeric id
        'text' => $text,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => $buttonText,
                        'url' => $buttonUrl
                    ]
                ]
            ]
        ])
    ]);
}


public static function sendProductPost($chatId, $photoUrl, $product)
{
    $caption = "*{$product['name']}*\n";
    $caption .= "{$product['description']}\n";
    $caption .= "_Category: {$product['category']}_";

    return Http::post(self::baseUrl() . 'sendPhoto', [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => '🛒 Open Mini App',
                        'url' => ['url' => $product['web_app_url']]
                    ]
                ]
            ]
        ])
    ]);
}



}
