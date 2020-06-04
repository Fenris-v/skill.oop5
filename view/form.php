<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <ul>
        <li>
            <label>
                <input name="name" type="text" placeholder="name">
            </label>
        </li>
        <li>
            <label>
                <input name="age" type="number" placeholder="age">
            </label>
        </li>
        <li>
            <label>
                <input name="email" type="text" placeholder="email">
            </label>
        </li>
        <li>
            <input type="submit">
        </li>
    </ul>
</form>
</body>
</html>
