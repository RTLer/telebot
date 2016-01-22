<?php
namespace RTLer\Telebot;

class Webhook
{
    private $response;
    private $input;

    public function __construct()
    {
        $this->response = new Response();
        $this->input = $this->response->parseInputs(file_get_contents("php://input"));
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
        $data["method"] = $type;
        if ($print) {
            $this->printApiAnswer($data);
        }
        return $data;
    }

    public function responseMessage($regex, $callback, $print = false)
    {
      if($this->response->hasType('message') && preg_match($regex, $this->input->text)){
        $data = $this->response->response('message', $this->input, $callback);
        $data["method"] = $type;
        if ($print) {
          $this->printApiAnswer($data);
        }
        return $data;
      }
      return false;
    }

}
