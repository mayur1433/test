<?php
/**
 * Created by PhpStorm.
 * User: Mayur
 * Date: 06-08-2018
 * Time: 18:10
 */
if(isset($_REQUEST['logout'])){
    session_start();
    unset($_SESSION['fb_access_token']);
    header('Location: ./');
}
?>