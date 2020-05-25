<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial=scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-glyphicons.css">
	<title>Главная</title>
</head>
<body>

	<?php
        require "blocks/header.php";
    ?>

    <div class="container mt-4">
        <h3>Оставьте ваш комментарий</h3>
        <div class="comments">
            <?php if ($comments = $connect->query("SELECT 
                                                            c.id,
                                                            c.user_id,
                                                            c.comment,
                                                            c.date,
                                                            u.name,
                                                            u.email,
                                                            u.password,
                                                            u.isAdmin,
                                                            u.image 
                                                          FROM comments c LEFT JOIN users u ON c.user_id = u.id")): ?>
                <ul class="list-group">
                    <?php foreach ($comments as $comment): ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-2 col-md-1">
                                    <img src="<?= ($comment['image'] == null) ? 'img/default.png' : $comment['image'] ?>" class="rounded-circle" alt="avatar" style="width: 84px; height: 84px;"></div>
                                <div class="col-xs-10 col-md-11">
                                    <div>
                                        <?= ($comment['name'] != '') ? $comment['name'] : 'Гость' ?>
                                        <div class="mic-info"><?= date('d.m.Y', $comment['date']) ?></div>
                                    </div>
                                    <div class="comment-text">
                                        <?= $comment['comment'] ?>
                                    </div>
                                    <?php if ($_SESSION['user']['role']): ?>
                                        <form method="post" action="vendor/guestBook.php">
                                            <div class="action" style="float: right; width: content-box;">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete_btn" title="Delete">
                                                    <span>Удалить</span>
                                                </button>
                                                <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>"/>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div><br>
        <div class="comments-form">
            <form action="vendor/guestBook.php" method="post">
                <p>
                    <label for="text"></label>
                    <textarea class="form-control" name="text" id="text" placeholder="Введите Ваш комментарий..." rows="5"></textarea>
                </p>
                <button type="submit" class="btn btn-success">Отправить</button>
            </form>
        </div>

    </div>


</body>
</html>