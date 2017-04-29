<?php

require_once('classes/Facebook.php');

class page
{
    public $id;
    public $link;
    public $name;
    public $posts =array();

    public function __construct($id)
    {
        $url = 'https://graph.facebook.com/'.$id.'?fields=id,link,name,feed{name,message,attachments,comments,likes{link,name},sharedposts{link,name}}&access_token='.$_SESSION['access_token'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        $data=json_decode($res, true);
        $this->id=$data['id'];
        $this->link=$data['link'];
        $this->name=$data['name'];
        foreach ($data['feed']['data'] as $value) {
            array_push($this->posts, new Post($value));
        }
    }
    public function id()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPosts()
    {
        return $this->posts;
    }
    
}

?>