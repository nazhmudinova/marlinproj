<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial=scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Контакты</title>
</head>
<body>
	<?php
        require "blocks/header.php";
        $users = $connect->query("SELECT * from users");

        $id = (int)$_POST['id'];
        if (isset($_POST['delete_btn']))
        {
            $connect->query("DELETE FROM users WHERE id = '$id'");
        }
    ?>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="<?= ($user['image'] == null) ? 'img/default.png' : $user['image'] ?>" target="_blank">
                                    <img class="rounded-circle img-fluid"
                                         src="<?= ($user['image'] == null) ? 'img/default.png' : $user['image'] ?>" alt="avatar" style="width: 84px; height: 84px;">
                                </a>
                                <?php if ($_SESSION['user']['role'] && !$user['isAdmin']): ?>
                                <div class="pull-right btn-group-sm">
                                    <form method="post" action="">
                                        <div class="action" style="float: right; width: content-box;">
                                            <button type="submit" class="btn btn-danger btn-sm" name="delete_btn" title="Delete">
                                                <span>Удалить</span>
                                            </button>
                                            <input type="hidden" name="id" value="<?= $user['id']; ?>"/>
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>
                                <div class="info"><h4><?= ($user['isAdmin']) ? $user['name'] . ' | Администратор' : $user['name'] ?></h4>
                                    <p class="text-muted" style="margin: 0 0 10px;"><?= $user['email'] ?></p></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>