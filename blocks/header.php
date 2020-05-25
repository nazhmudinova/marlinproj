<?php
    require_once "vendor/connect.php";

    if(isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"])){

        $select_user_data = $connect->query("SELECT email, password FROM `users` WHERE password_cookie_token = '".$_COOKIE["password_cookie_token"]."'");

        if(!$select_user_data){
            echo "<p class='mesage_error' >Ошибка выборки БД.</p>".$connect->error();
        }else{
            $users = $select_user_data->fetch_array(MYSQLI_ASSOC);
            if($users){
                $_SESSION['user']['email'] = $users["email"];
                $_SESSION['user']['password'] = $users["password"];
            }
        }
    }
?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
	<h5 class="my-0 mr-md-auto font-weight-normal">Проект</h5>
	<nav class="my-2 my-md-0 mr-md-3">
		<a class="p-2 text-dark" href="index.php">Главная</a>
		<a class="p-2 text-dark" href="contacts.php">Контакты</a>
        <?php if($_SESSION['user']): ?>
			<a class="p-2 text-dark" href="account.php">Личный кабинет</a>
		<?php endif; ?>
	</nav>
	<?php if(!$_SESSION['user']): ?>
		<a class="btn btn-outline-primary" href="auth.php">Войти</a>
	<?php else: ?>
		<a class="btn btn-outline-primary" href="../vendor/logout.php">Выход</a>
	<?php endif; ?>
</div>