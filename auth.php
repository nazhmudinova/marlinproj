<?php
session_start();

if ($_SESSION['user'])
{
    header('Location: account.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial=scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Вход</title>
</head>
<body>
	<?php require "blocks/header.php" ?>

	<div class="container mt-4">
		<h3>Войти</h3>

		<form action="vendor/signin.php" method="post">
			<input type="email" class="form-control" name="email" id="email" placeholder="Введите email"><br>
			<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
			<button type="submit" class="btn btn-success">Войти</button>
            <p> У вас еще нет аккаунта? <a href="register.php">Зарегистрироваться</a> </p>
            <input type="checkbox" name="remember_me" checked="checked" /> Запомнить меня
            <?php if ($_SESSION['message']): ?>
                <p class="msg">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </p>
            <?php endif; ?>
		</form>
	</div>

</body>
</html>