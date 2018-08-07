<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
    'app_id' => '427269091099035',
    'app_secret' => 'f6a2b7db6c65a79339b729c10d35258c',
    'default_graph_version' => 'v3.1',
]);
$logout = 'http://localhost/rtcamp_test/?logout=true';
//check if users wants to logout
$permissions = []; // optional
$helper = $fb->getRedirectLoginHelper();
$accessToken = $helper->getAccessToken();
if (isset($_GET['logout'])) {
    unset($_SESSION['fb_access_token']);
}
if (isset($_SESSION['fb_access_token'])) {
    $accessToken = $_SESSION['fb_access_token'];
} else {
}
if (isset($accessToken)) {
    $_SESSION['fb_access_token'] = (string)$accessToken;
    $_SESSION['access_token'] = (string)$accessToken;
//    echo $_SESSION['fb_access_token'];
//    unset($_SESSION['fb_access_token']);
    //header("Location: $loginUrl");
    header("Location:$loginUrl");
    //echo "mayur";
} else {
    $loginUrl = $helper->getLoginUrl("http://localhost/rtcamp_test/album.php", $permissions);
    $_SESSION['fb_access_token'] = (string)$accessToken;
    $_SESSION['access_token'] = (string)$accessToken;
    //echo $accessToken;
    header("Location: $loginUrl");
}