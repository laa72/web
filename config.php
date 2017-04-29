<?php
$client_id = '622669274610825'; // ClientID
$client_secret = '049c86d376ab62c215982edefd991ee2'; // ClientSecretKey
$redirect_uri = 'http://localhost/'; // RedirectURIs

$url = 'https://www.facebook.com/dialog/oauth'; //BaseAuthURL

$params = array(
    'client_id' => $client_id, // ClientID
    'redirect_uri' => $redirect_uri, // RedirectURIs
    'response_type' => 'code', //Type_of_response_type
    'scope' => 'email,user_birthday,publish_actions,user_about_me,user_likes,user_hometown,user_status,user_website,user_managed_groups,publish_pages,manage_pages,pages_show_list,pages_manage_instant_articles,user_friends,user_posts'
    //Permissions
);
?>