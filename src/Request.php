<?php
namespace RTLer\Telebot;

class Request
{
    public $response;
    private $url;

    public function __construct($url)
    {
        $this->response = new Response();
        $this->url = $url;
    }

    public function request($type, $data, $callback)
    {
        $result = $this->sendRequest($type, $data);
        if ($this->response->request->hasType($type, $data)) {
            return $this->response->response($type, $result, $callback);
        }

        return null;
    }

    /**
     * @param $type
     * @param $data
     *
     * @return mixed
     */
    protected function sendRequest($type, $data)
    {
        $ch = curl_init($this->url . '/' . $type);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = $this->response->parseInputs(curl_exec($ch));
        curl_close($ch);
        return $result;
    }
}