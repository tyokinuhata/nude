<?php

// DB接続
try {
    $sqlite = new PDO("sqlite:./database/database.sqlite");
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}

// 投稿の取得処理
try {
    $sql = 'SELECT * FROM `post` ORDER BY `created_at` DESC';
    $posts = $sqlite->query($sql);
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 名前の入力チェック
    $name = null;
    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = 'Please enter your name.';
    } else if (strlen($_POST['name'] > 40)) {
        $errors['name'] = 'Name is too long.';
    } else {
        $name = $_POST['name'];
    }

    // コメントの入力チェック
    $comment = null;
    if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $errors['comment'] = 'Please enter your name.';
    } else if (strlen($_POST['comment'] > 200)) {
        $errors['comment'] = 'Name is too long.';
    } else {
        $comment = $_POST['comment'];
    }

    $date = date('Y-m-d H:i:s');

    // 保存処理
    if (count($errors) === 0) {
        try {
            $sql = $sqlite->prepare('INSERT INTO `post` (
                `name`, `comment`, `created_at`
            ) VALUES (
                :name, :comment, :created_at
            )');
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql->bindParam(':created_at', $date, PDO::PARAM_STR);
            $sql->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}

// DB切断
$sqlite = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nude</title>
    </head>
    <body>
        <h1>Nude</h1>
        <form action="index.php" method="post">
            Name: <input type="text" name="name"><br>
            <?php if (isset($errors['name'])): ?>
                <ul>
                    <li><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></li>
                </ul>
            <?php endif; ?>

            Comment: <input type="text" name="comment" size="60"><br>
            <?php if (isset($errors['comment'])): ?>
                <ul>
                    <li><?= htmlspecialchars($errors['comment'], ENT_QUOTES, 'UTF-8') ?></li>
                </ul>
            <?php endif; ?>
            <input type="submit" name="submit" value="Send">
        </form>

        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <?= htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?>:
                    <?= htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8') ?> -
                    <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>