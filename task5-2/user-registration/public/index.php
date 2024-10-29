<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

$config = require __DIR__ . '/../config/config.php';
$db = new PDO('sqlite:' . $config['db_path']);
$authController = new AuthController($db, $config);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $authController->register($_POST['email'], $_POST['password']);
} elseif (isset($_GET['token'])) {
    $authController->confirm($_GET['token']);
} else {
    require __DIR__ . '/../views/register.php';
}
