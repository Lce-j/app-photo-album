<?php
session_start();

require_once('../includes/database.php');

$email = $_POST['email'];
$password = $_POST['password'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT * FROM user WHERE email = :email";

    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch();

    // var_dump($user);
    // echo $password;
    // var_dump(password_verify($password, $user['password']));

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header("Location: http://localhost/app-photo-album/frontend/pages/dashboard.php");
        exit();
        
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'E-mail ou mot de passe invalide !';
    }
}