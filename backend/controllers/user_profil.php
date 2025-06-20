<?php
require_once("../includes/database.php");
session_start();

$user = $_SESSION['user'];
$save_button = $_POST['update-profil'] ?? null;
$delete_button = $_POST['delete-profil'] ?? null;

if (isset($save_button)) {
    // $user_id = $_SESSION['id'];
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $password = $_POST['passwword'];
    // $update = $bdd->prepare("UPDATE user SET first_name = :fisrt_name, last_name = :last_name, email = :email, password = :password WHERE id = :id");
    // $update->bindParam(':id', $user_id);
    // $update->bindParam(':first_name', $first_name);
    // $update->bindParam(':last_name', $last_name);
    // $update->bindParam(':email', $email);
    // $update->bindParam(':password', $password);
    // $update->execute();
    echo "<p style='color:green;'>Profil mis à jour.</p>";
        header("Location: http://localhost/app-photo-album/frontend/pages/dashboard.php");

}

if (isset($delete_button)) {
    $stmt = $bdd->prepare('DELETE FROM user WHERE id = :id');
    // $stmt->bindParam(':id', 6);
    $stmt->bindValue(':id', 7);
    $stmt->execute();
}