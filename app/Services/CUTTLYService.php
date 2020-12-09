<?php
namespace App\Services;
use Illuminate\Support\Str;

class CUTTLYService
{
    protected $url;
    protected $key;

    public function __construct($url, $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

    public function getShortLink($link)
    {
        $name = Str::random(4);
 
        $json = file_get_contents($this->url."?key=$this->key&short=$link&name=$name");
        $data = json_decode ($json, true);

        $shortlink = $data["url"]["shortLink"];

        return $shortlink;
    }

}
