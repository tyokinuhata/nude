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