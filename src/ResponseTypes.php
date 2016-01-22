<?php
namespace RTLer\Telebot;

class ResponseTypes
{
    protected $validator;

    public function __construct()
    {
        $this->validator = new validator();
    }

    public function allTypes()
    {
        return [
            'user'                => $this->user(),
            'chat'                => $this->chat(),
            'message'             => $this->message(),
            'photoSize'           => $this->photoSize(),
            'audio'               => $this->audio(),
            'document'            => $this->document(),
            'sticker'             => $this->sticker(),
            'video'               => $this->video(),
            'voice'               => $this->voice(),
            'contact'             => $this->contact(),
            'location'            => $this->location(),
            'userProfilePhotos'   => $this->userProfilePhotos(),
            'file'                => $this->file(),
            'replyKeyboardMarkup' => $this->replyKeyboardMarkup(),
            'replyKeyboardHide'   => $this->replyKeyboardHide(),
            'forceReply'          => $this->forceReply(),
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
      $typeObj = $this->allTypes()[$type];
        return $this->validator->isMatch($typeObj, $object);
    }

    public function detail($type = 'string', $optional = true)
    {
        return ['type' => $type, 'optional' => $optional];
    }

    public function user()
    {
        return [
            'id'         => $this->detail('int', false),
            'first_name' => $this->detail('string', false),
            'last_name'  => $this->detail('string', true),
            'username'   => $this->detail('string', true),
        ];
    }

    public function chat()
    {
        return [
            'id'         => $this->detail('int', false),
            'type'       => $this->detail('string', false),
            'title'      => $this->detail('string', true),
            'username'   => $this->detail('string', true),
            'first_name' => $this->detail('string', true),
            'last_name'  => $this->detail('string', true),
        ];
    }

    public function message()
    {
        return [
            'message_id'              => $this->detail('int', false),
            'from'                    => $this->detail('user', true),
            'date'                    => $this->detail('int', false),
            'chat'                    => $this->detail('chat', false),
            'forward_from'            => $this->detail('user', true),
            'forward_date'            => $this->detail('int', true),
            'reply_to_message'        => $this->detail('message', true),
            'text'                    => $this->detail('string', true),
            'audio'                   => $this->detail('audio', true),
            'document'                => $this->detail('document', true),
            'photo'                   => $this->detail('array:photo', true),
            'sticker'                 => $this->detail('sticker', true),
            'video'                   => $this->detail('video', true),
            'voice'                   => $this->detail('voice', true),
            'caption'                 => $this->detail('string', true),
            'contact'                 => $this->detail('contact', true),
            'location'                => $this->detail('location', true),
            'new_chat_participant'    => $this->detail('user', true),
            'left_chat_participant'   => $this->detail('user', true),
            'new_chat_title'          => $this->detail('string', true),
            'new_chat_photo'          => $this->detail('array:photoSize', true),
            'delete_chat_photo'       => $this->detail('boolean', true),
            'group_chat_created'      => $this->detail('boolean', true),
            'supergroup_chat_created' => $this->detail('boolean', true),
            'channel_chat_created'    => $this->detail('boolean', true),
            'migrate_to_chat_id'      => $this->detail('int', true),
            'migrate_from_chat_id'    => $this->detail('int', true),
        ];
    }

    public function photoSize()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'width'     => $this->detail('int', false),
            'height'    => $this->detail('int', false),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function audio()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'duration'  => $this->detail('int', false),
            'performer' => $this->detail('string', true),
            'title'     => $this->detail('string', true),
            'mime_type' => $this->detail('string', true),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function document()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'thumb'     => $this->detail('photoSize', true),
            'file_name' => $this->detail('string', true),
            'mime_type' => $this->detail('string', true),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function sticker()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'width'     => $this->detail('int', false),
            'height'    => $this->detail('int', false),
            'thumb'     => $this->detail('photoSize', true),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function video()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'width'     => $this->detail('int', false),
            'height'    => $this->detail('int', false),
            'duration'  => $this->detail('int', false),
            'thumb'     => $this->detail('photoSize', true),
            'mime_type' => $this->detail('string', true),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function voice()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'duration'  => $this->detail('int', false),
            'mime_type' => $this->detail('string', true),
            'file_size' => $this->detail('int', true),
        ];
    }

    public function contact()
    {
        return [
            'phone_number' => $this->detail('string', false),
            'first_name'   => $this->detail('string', false),
            'last_name'    => $this->detail('string', true),
            'user_id'      => $this->detail('int', true),
        ];
    }

    public function location()
    {
        return [
            'longitude' => $this->detail('float', false),
            'latitude'  => $this->detail('float', false),
        ];
    }

    public function userProfilePhotos()
    {
        return [
            'total_count' => $this->detail('int', false),
            'photos'      => $this->detail('array:photoSize', false),
        ];
    }

    public function file()
    {
        return [
            'file_id'   => $this->detail('string', false),
            'file_size' => $this->detail('int', true),
            'file_path' => $this->detail('string', true),
        ];
    }

    public function replyKeyboardMarkup()
    {
        return [
            'keyboard'          => $this->detail('array:array:string', false),
            'resize_keyboard'   => $this->detail('Boolean', true),
            'one_time_keyboard' => $this->detail('Boolean', true),
            'selective'         => $this->detail('Boolean', true),
        ];
    }

    public function replyKeyboardHide()
    {
        return [
            'hide_keyboard' => $this->detail('Boolean', false),
            'selective'     => $this->detail('Boolean', true),
        ];
    }

    public function forceReply()
    {
        return [
            'force_reply' => $this->detail('Boolean', false),
            'selective'   => $this->detail('Boolean', true),
        ];
    }

    public function inlineQuery()
    {
        return [
            'id'     => $this->detail('string', false),
            'from'   => $this->detail('user', false),
            'query'  => $this->detail('string', false),
            'offset' => $this->detail('string', false),
        ];
    }
}
