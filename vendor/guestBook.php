<?php session_start(); ?>
<?php
require_once "connect.php";
$comment_id = (int)$_POST['comment_id'];
if (isset($_POST['delete_btn']))
{
    $connect->query("DELETE FROM comments WHERE id = '$comment_id'");
}

$user_id = (int)$_SESSION['user']['id'];
$text = $connect->real_escape_string(trim($_POST['text']));
$date = time();
if ($user_id && $text)
{
    $connect->query("INSERT INTO comments (user_id, comment, date) VALUE('$user_id', '$text', '$date')");
}

header('Location: /');
