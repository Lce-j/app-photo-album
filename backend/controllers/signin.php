<?php

require_once('../includes/database.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars($_POST['first-name']);
    $last_name = htmlspecialchars($_POST['last-name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT );
    $is_admin= '0';
    
    $stmt = $bdd->prepare("INSERT INTO user (id, first_name, last_name, email, password, is_admin) VALUES (NULL, :first_name, :last_name, :email, :password, :is_admin)");
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Vous vous êtes bien enregistré.e !';
        header("Location: http://localhost/app-photo-album");
        exit();
    }
}