<?php
namespace RTLer\Telebot;

class Response
{
    public $request;
    public $response;

    public function __construct()
    {
        $this->response = new ResponseTypes();
        $this->request = new RequestTypes();
    }

    public function response($type, $data, $callback)
    {
        if ($this->response->hasType($type, $data)) {
            return $callback($data);
        }
        return null;
    }

    public function parseInputs($inputs)
    {
        return json_decode($inputs, true);
    }
}