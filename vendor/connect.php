<?php
$connect = mysqli_connect(
    'localhost',
    'root',
    '',
    'marlinproj'
);
if (!$connect) {
    die("Невозможно подключиться к базе данных. Код ошибки: %s\n" . mysqli_connect_error());
}