<?php
session_start();
require_once "connect.php";
if(isset($_COOKIE["password_cookie_token"])){
    $update_password_cookie_token = $connect->query("UPDATE users SET password_cookie_token = '' WHERE email = '".$_SESSION["email"]."'");
    if(!$update_password_cookie_token){
        echo "Ошибка ".$connect->error();
    }else{
        setcookie("password_cookie_token", "", time() - 3600);
    }
}
unset($_SESSION['user']);
unset($_SESSION['message']);
header('Location: /');