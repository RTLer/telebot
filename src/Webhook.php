<?php
namespace RTLer\Telebot;

class Webhook
{
    private $response;
    private $input;

    public function __construct()
    {
        $this->response = new Response();
        $this->input = $this->response->parseInputs(file_get_contents("php://input"))['message'];
    }

    public function printApiAnswer($output)
    {
        header("Content-Type: application/json");
        echo json_encode($output);
        die;
    }

    public function response($type, $callback, $print = false)
    {
        $data = $this->response->response($type, $this->input, $callback);
        if ($print) {
            $this->printApiAnswer($data);
        }
        return $data;
    }

    public function responseMessage($regex, $callback, $print = false)
    {
      if($this->response->response->hasType('message', $this->input) && preg_match($regex, $this->input['text'])){
        return $this->response('message', $callback, $print);
      }
      return null;
    }

}