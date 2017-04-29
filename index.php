<?php
session_start();
require_once('classes/Facebook.php');
require_once('classes/User.php');
if (isset($_GET['code'])) {
    $_SESSION['code'] = $_GET['code'];
    header('Location:/profile.php');
} else if (isset($_SESSION['code'])) //&& !isset($_GET['code']))
    header('Location:/profile.php');

if (!isset($_SESSION['code']) && !isset($_GET['code']))
    echo '<a href="' . Facebook::getAuthLink() . '"><---GO---></a></div>';

?>


