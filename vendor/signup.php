<?php
session_start();
require_once "connect.php";

$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if(strlen($name) < 2 || strlen($name) > 50)
{
	$_SESSION['message'] = "<p class='mesage_error' >Недопустимая длина имени</p>";
	header('Location: ../register.php');
	exit();
} elseif (strlen($password) < 3 || strlen($password) > 30) {
    $_SESSION['message'] = "<p class='mesage_error' >Пароль должен быть не короче 3 и не длиннее 30 символов</p>";
    header('Location: ../register.php');
    exit();
}

$password = md5($password . "hatwd0hw78h");

$connect->query("INSERT INTO `users` (`name`, `email`, `password`) VALUES('$name', '$email', '$password')");
$connect->close();
$_SESSION['message'] = "<p class='success_message' >Вы успешно зарегистрировались!";
header('Location: /auth.php');
