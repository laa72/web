<html>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
<body>
<?php
require_once('classes/Facebook.php');
require_once('classes/User.php');
require_once('classes/Page.php');
require_once('classes/Post.php');
require_once('view.php');
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: http://localhost');
}
if (isset($_SESSION['code'])) {
    if (!isset($_SESSION['facebook'])) {
        $_SESSION['facebook'] = new Facebook();
        $facebook = $_SESSION['facebook'];
        $_SESSION['access_token'] = $facebook->get_access_token($_SESSION['code']);
        $user = $facebook->getUser($_SESSION['access_token']);
    } else {
        $facebook = $_SESSION['facebook'];
        $user = $facebook->getUser($_SESSION['access_token']);
    }
} else header('Location: /');

echo getHtmlUser($user);
echo getHtmlPages($user);
?>
</div>
<script type="text/javascript">
    $('#my-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
        })
</script>

</body>
</html>