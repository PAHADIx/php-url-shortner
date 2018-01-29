<?php

namespace Framework\Social;


class Instagram {
    private $result = [];
    public $access_token = INSTAGRAM_TOKEN; // default access token, optional
    public $count = 10;
    public $userId = 2256663036;

    public function fetch($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function __construct(){
        $result = json_decode($this->fetch("https://api.instagram.com/v1/users/".$this->userId."/media/recent?".
            "count=" .  $this->count .
            "&access_token=" . $this->access_token),
            true);
        $this->cleanUp($result);
    }

    function user($userId){
        $this->userId = $userId;
        return $this;
    }
    function count($count){
        $this->userId = $count;
        return $this;
    }

    function cleanUp($result){
        foreach($result["data"] as $item){
            $post = new \stdClass();
            $post->link = $item["link"];
            $post->likes = $item["likes"]["count"];

            $post->time = new \DateTime();
            $post->time->setTimestamp($item["created_time"]);

            $post->title = $item["caption"]["text"];
            $post->image = $item["images"]["standard_resolution"]["url"];
            //$post->image->thumb = $item["images"]["thumbnail"]["url"];
            //$post->image->highRes = $item["images"]["standard_resolution"]["url"];
            $post->via = "Instagram";
            $this->result[] = $post;
        }
    }
    public function getPosts(){
        return $this->result;
    }

}
