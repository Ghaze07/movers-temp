<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    protected $url;
    protected $key;
    protected $from;
    protected $to;
    protected $message;

    public function __construct($url, $key, $from)
    {
        $this->url = $url;
        $this->key = $key;
        $this->from = $from;
    }

    public function sendSMS($to, $message)
    {
        $parameters = [
            'hash' => $this->key,
            'sendernum' => $this->from,
            'receivernum' => $to,
            'textmessage' => $message
        ];
        $res = Http::get($this->url, $parameters);

        return json_decode((string) $res->getBody());
    }
}