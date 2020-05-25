<?php
session_start();
require_once "connect.php";

$id = (int)$_SESSION['user']['id'];
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

if(strlen($name) < 2 || strlen($name) > 50)
{
    $_SESSION['message'] = "<p class='mesage_error' >Недопустимая длина имени</p>";
    header('Location: ../account.php');
    exit();
}
if(strlen($password) != '')
{
    if (strlen($password) < 3 || strlen($password) > 30) {
        $_SESSION['message'] = "<p class='mesage_error' >Пароль должен быть не короче 3 и не длиннее 30 символов</p>";
        header('Location: ../account.php');
        exit();
    }
    $password = md5($password);
    $connect->query("UPDATE users SET password = '$password' WHERE id = '$id'");
}
if ($_SESSION['user']['img'] == '')
{
    $img = $_FILES['img'];
    if ($img['name'] != '' || $img['name'] != 'img/default.png')
    {
        $path = 'img/' . time() . $img['name'];
        if(!move_uploaded_file($img['tmp_name'], '../' . $path))
        {
            $_SESSION['message'] = "<p class='mesage_error' >Ошибка при загрузке изображения</p>";
            header('Location: ../account.php');
            exit();
        }
        $_SESSION['user']['img'] = $path;
        $connect->query("UPDATE users SET image = '$path' WHERE id = '$id'");
    }
}

$_SESSION['user']['name'] = $name;

$connect->query("UPDATE users SET name = '$name' WHERE id = '$id'");
$connect->close();
$_SESSION['message'] = "<p class='success_message' >Данные успешно обновлены</p>";
header('Location: ../account.php');

