<?php
namespace App\Controllers;

use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController {
    private $userModel;
    private $config;

    public function __construct($db, $config) {
        $this->userModel = new User($db);
        $this->config = $config;
    }

    public function register($email, $password) {
        $token = bin2hex(random_bytes(16));
        $this->userModel->register($email, $password, $token);
        $this->sendConfirmationEmail($email, $token);
    }

    public function confirm($token) {
        if ($this->userModel->confirmUser($token)) {
            echo "Your email has been confirmed!";
        } else {
            echo "Invalid token!";
        }
    }

    private function sendConfirmationEmail($email, $token) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $this->config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['smtp_user'];
        $mail->Password = $this->config['smtp_pass'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $this->config['smtp_port'];

        $mail->setFrom($this->config['smtp_user'], 'Web Store');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Confirm your email';
        $mail->Body = "Please confirm your email by clicking <a href='http://localhost/confirm.php?token=$token'>here</a>.";

        $mail->send();
    }
}
