<?php
namespace RTLer\Telebot;

class RequestTypes
{
    protected $validator;

    public function __construct()
    {
        $this->validator = new validator();
    }

    public function validateRequest($type, $request)
    {
        return $this->validator->isMatch($type, $request, true);
    }

    public function makeRequest($type, $data)
    {
        if ($this->validateRequest($type, $data)) {
            return $data;
        }
        return null;
    }

    public function allTypes()
    {
        return [
            'getMe'                => $this->getMe(),
            'sendMessage'          => $this->sendMessage(),
            'forwardMessage'       => $this->forwardMessage(),
            'sendPhoto'            => $this->sendPhoto(),
            'sendAudio'            => $this->sendAudio(),
            'sendDocument'         => $this->sendDocument(),
            'sendSticker'          => $this->sendSticker(),
            'sendVideo'            => $this->sendVideo(),
            'sendVoice'            => $this->sendVoice(),
            'sendLocation'         => $this->sendLocation(),
            'sendChatAction'       => $this->sendChatAction(),
            'getUserProfilePhotos' => $this->getUserProfilePhotos(),
            'getFile'              => $this->getFile(),
            'answerInlineQuery'    => $this->answerInlineQuery(),
        ];
    }

    public function getType($object)
    {
        foreach ($this->allTypes() as $type) {
            if ($this->validator->isMatch($type, $object)) {
                return $type;
            }
        }
        return null;
    }

    public function hasType($type, $object)
    {
        return $this->validator->isMatch($type, $object);
    }

    public function getMe()
    {
        return [];
    }

    public function sendMessage()
    {
        return [
            'chat_id'                  => $this->detail('int|string', false),
            'text'                     => $this->detail('String', false),
            'parse_mode'               => $this->detail('String', true),
            'disable_web_page_preview' => $this->detail('Boolean', true),
            'reply_to_message_id'      => $this->detail('Integer', true),
            'reply_markup'             => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function forwardMessage()
    {
        return [
            'chat_id'      => $this->detail('int|string', true),
            'from_chat_id' => $this->detail('int|string', true),
            'message_id'   => $this->detail('int', true),
        ];
    }

    public function sendPhoto()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'photo'               => $this->detail('inputFile|string', false),
            'caption'             => $this->detail('string', true),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendAudio()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'audio'               => $this->detail('inputFile|string', false),
            'duration'            => $this->detail('int', true),
            'performer'           => $this->detail('string', true),
            'title'               => $this->detail('string', true),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendDocument()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'document'            => $this->detail('inputFile|string', false),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendSticker()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'sticker'             => $this->detail('inputFile|string', false),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendVideo()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'video'               => $this->detail('inputFile|string', false),
            'duration'            => $this->detail('int', true),
            'caption'             => $this->detail('string', true),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendVoice()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'voice'               => $this->detail('inputFile|string', false),
            'duration'            => $this->detail('int', true),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendLocation()
    {
        return [
            'chat_id'             => $this->detail('int|string', false),
            'latitude'            => $this->detail('float', false),
            'longitude'           => $this->detail('float', false),
            'reply_to_message_id' => $this->detail('int', true),
            'reply_markup'        => $this->detail('replyKeyboardMarkup|replyKeyboardHide|forceReply', true),
        ];
    }

    public function sendChatAction()
    {
        return [
            'chat_id' => $this->detail('int|string', false),
            'action'  => $this->detail('String', false),
        ];
    }

    public function getUserProfilePhotos()
    {
        return [
            'user_id' => $this->detail('int', false),
            'offset'  => $this->detail('int', true),
            'limit'   => $this->detail('int', true),
        ];
    }

    public function getFile()
    {
        return [
            'file_id' => $this->detail('String', false),
        ];
    }

    public function answerInlineQuery()
    {
        return [
            'inline_query_id' => $this->detail('String', false),
        ];
    }


    public function detail($type = 'string', $optional = true)
    {
        return ['type' => $type, 'optional' => $optional];
    }

}