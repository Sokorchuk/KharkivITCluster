<?php
// views/product.php

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перелік товарів</title>
</head>
<body>
    <h1>Перелік товарів</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo $product['name']; ?> - <?php echo $product['price']; ?> грн.
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
