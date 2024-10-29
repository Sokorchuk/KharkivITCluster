<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід до магазину</title>
    <link rel="stylesheet" href="styles.css"> <!-- Підключення CSS стилів, за потреби -->
</head>
<body>
    <div class="login-container">
        <h2>Вхід до облікового запису</h2>
        <form action="/login_action.php" method="POST">
            <div class="form-group">
                <label for="email">Електронна адреса:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Увійти</button>
        </form>
        <p>Не маєте облікового запису? <a href="/register.php">Зареєструватися</a></p>
    </div>
</body>
</html>
