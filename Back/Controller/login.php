<?php

require "database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = htmlspecialchars($_POST['email']);
    $query = "SELECT * FROM user WHERE email = :email";

    $stmt = $bdLink->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['connexion'] = 'connected';
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Vous vous êtes bien connecté.e !';
        header("Location: C:\wamp64\www\app-photo-album\Front\View\home.html");
        
        exit();
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'E-mail ou mot de passe invalide !';
    }
}