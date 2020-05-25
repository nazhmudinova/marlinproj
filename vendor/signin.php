<?php
session_start();
require_once "connect.php";

$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password = md5($password . "hatwd0hw78h");

$result = $connect->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
if($result->num_rows == 0)
{
    $_SESSION['message'] = "<p class='mesage_error' >Неверный логин или пароль</p>";
    header('Location: ../auth.php');
    exit();
}
$user = $result->fetch_assoc();

if(isset($_POST["remember_me"])){
    $password_cookie_token = md5($user["id"].$password.time());

    $update_password_cookie_token = $connect->query("UPDATE users SET password_cookie_token='".$password_cookie_token."' WHERE email = '".$email."'");

    if(!$update_password_cookie_token){
        $_SESSION["messages"] = "<p class='mesage_error' >Ошибка функционала 'запомнить меня'</p>";

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ../auth.php");
        exit();
    }
    setcookie("password_cookie_token", $password_cookie_token, time() + (1000 * 60 * 60 * 24 * 30));
}else{
    if(isset($_COOKIE["password_cookie_token"])){
        $update_password_cookie_token = $connect->query("UPDATE users SET password_cookie_token = '' WHERE email = '".$email."'");
        setcookie("password_cookie_token", "", time() - 3600);
    }
}

$_SESSION['user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'role' => $user['isAdmin'],
    'img' => $user['image'],
];

$connect->close();
header('Location: ../account.php');
