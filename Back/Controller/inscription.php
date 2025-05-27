<?php

require "database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['nom']);
    $first_name = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT );
    $is_admin= '0';
    
    $stmt = $bdLink->prepare("INSERT INTO utilisateur (nom, prenom, email, password, is_admin) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $first_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);
    $stmt->bindParam(4, $password, PDO::PARAM_STR);
    $stmt->bindParam(5, $is_admin, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Vous vous êtes bien enregistré.e !';
        header("Location: login.php");
        exit();
    }
}