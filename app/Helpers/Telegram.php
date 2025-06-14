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

}
