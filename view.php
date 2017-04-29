<?php
require_once('classes/Facebook.php');
require_once('classes/User.php');

function getHtmlPost($data)
{
    $HTML='<div id="'.$data->getId().'" class="post text-center">
        <h3 class="headerPosts">'. $data->getName(). '</h3>
        <p class="message">'. $data->getMessage(). '</p>';
    $images=$data->getImage();
        foreach ($images as $value) {
        $HTML.='<img src="'.$value.'">';
        }
    
    $comments=$data->getComents();
    $HTML.='<div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#'.$data->getId().'_com" data-toggle="collapse" data-parent="#collapse-group" aria-expanded="false" class="collapsed"><span class="glyphicon glyphicon-pencil">Коментарии ('.count($comments).')</a></h4>
                </div>
                <div id="'.$data->getId().'_com" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">';
    foreach ($comments as $value) 
    {
        $HTML.='<p>'.$value['created_time'].' / '.$value['from']['name'].' </br> '.$value['message'].'</p>';
    }
    $likes=$data->getLikes();
            $HTML.='</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#'.$data->getId().'_like" data-toggle="collapse" data-parent="#collapse-group" class="collapsed" aria-expanded="false"><span class="glyphicon glyphicon-thumbs-up">Лайки ('.count( $likes).')</a></h4>
                </div>
                <div id="'.$data->getId().'_like" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">';
    foreach ($likes as $value)
    {
        $HTML.='<p><a href="'.$value['link'].'">'.$value['name'].'</a></p>';
    }
    $reposts=$data->getReposts();
            $HTML.='</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#'.$data->getId().'_post" data-toggle="collapse" data-parent="#collapse-group" class="collapsed" aria-expanded="false"><span class="glyphicon glyphicon-share-alt">Репосты ('.count($reposts).')</a></h4>
                </div>
                <div id="'.$data->getId().'_post" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">';
    foreach ($reposts as $value)
    {
        $HTML.='<p><a href="'.$value['link'].'">'.$value['name'].'</a></p>';
    }
            $HTML.='</div>
                </div>
            </div>
        </div>
    </div>';
    return $HTML;
}
function getHtmlUser($user)
{
    $HTML='<header>
    <div class="user_photo" style="float:left;"><img src="http://graph.facebook.com/' .$user->getID(). '/picture?type=large"></div>
    <div class="user_info" style="float: left;">
        <p class="user_fio">'.$user->getFullName().'</p>
        <p class="user_id">'.$user->getID().'</p>
        <p class="user_bd">'.$user->getBirthday().'</p>
        <p class="user_link">'.$user->getUserLink().'</p>
    </div>
    <div class="exit" style="float: right;">
        <a href="?logout=true"> <span class="glyphicon glyphicon-log-out"></span>Выйти</a>
    </div>
</header>';
    return $HTML;
}
function getHtmlPages($user)
{
    $HTML='<div class="container">
        <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Моя страница</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Группы  
            </a>
            <ul class="dropdown-menu">';
    $groups=$user->getUserGroups();
    foreach ($groups as $value)
    {
        $HTML.='<li><a href="#'.$value->id().'" data-toggle="tab" aria-expanded="false">'.$value->getName().'</a></li>';
    }
        $HTML.='</ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                Страницы    
            </a>
            <ul class="dropdown-menu">';
    $page=$user->getUserLikes();
    foreach ($page as $value)
    {
        $HTML.='<li><a href="#'.$value->id().'" data-toggle="tab" aria-expanded="false">'.$value->getName().'</a></li>';
        
    }
        $HTML.='
            </ul>
        </li>
    </ul><div class="tab-content">
        <div class="tab-pane fade in active" id="home">';
    $temp=$user->getPageMe();
    $posts=$temp->getPosts();
    foreach ($posts as $post) {
        $HTML.=getHtmlPost($post);
    }
    $HTML.='</div>';
    foreach ($groups as $value)
    {
            $HTML.='<div class="tab-pane fade" id="'.$value->id().'">';
            $posts=$value->getPosts();
            foreach ($posts as $post)
            {
                $HTML.=getHtmlPost($post);
            }
            $HTML.='</div>';
    }
    foreach ($page as $value)
    {
            $HTML.='<div class="tab-pane fade" id="'.$value->id().'">';
            $posts=$value->getPosts();
            foreach ($posts as $post)
            {
                $HTML.=getHtmlPost($post);
            }
            $HTML.='</div>';

        
    }
    $HTML.='</div>
    </div>';
    return $HTML;
}
?>