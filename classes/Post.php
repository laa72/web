<?php

require_once('classes/Facebook.php');

class post
{
    public $id;
    public $name;
    public $message;
    public $image = array();
    public $coments = array();
    public $likes = array();
    public $reposts = array();

    public function __construct($data)
    {
        if (isset($data['id']))
            $this->id = $data['id'];
        if (isset($data['name']))
            $this->name = $data['name'];
        if (isset($data['message']))
            $this->message = $data['message'];

        if (isset($data["attachments"]["data"][0]['subattachments']))
        {
            foreach ($data["attachments"]["data"][0]['subattachments']['data'] as $value) {
            array_push($this->image,$value["media"]["image"]["src"]);
            }
        }
        else
        if (isset($data["attachments"]["data"]))
        foreach ($data["attachments"]["data"] as $value) {
            array_push($this->image,$value["media"]["image"]["src"]);
        }


        if (isset($data['coments']))
            foreach ($data['coments']['data'] as $value) {
                array_push($this->coments, $value);
            }

        if (isset($data['likes']))
            foreach ($data['likes']['data'] as $value) {
                array_push($this->likes, $value);
            }

        if (isset($data['sharedposts']))
            foreach ($data['sharedposts']['data'] as $value) {
                array_push($this->reposts, $value);
            }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getComents()
    {
        return $this->coments;
    }
    public function getLikes()
    {
        return $this->likes;
    }
    public function getReposts()
    {
        return $this->reposts;
    }

}

?>