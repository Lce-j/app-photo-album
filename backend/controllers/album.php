<?php

//voir son nombre d'album, album partagé
//create user

// session_start();

if (isset($_SESSION['user'])) {
        $title = htmlspecialchars($_POST['title']);
        $date = htmlspecialchars($_POST['date']);
        
        $stmt = $bdd->prepare("INSERT INTO album (id, title, date) VALUES (NULL, :title, :date)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Vous vous êtes bien enregistré.e !';
            header("Location: http://localhost/app-photo-album/frontend/pages/albums/show_album.php");
            exit();
        }
    }

//delete user
if (isset($_SESSION['user'])) {
        if (isset($delete_button)) {
            $stmt = $bdd->prepare('DELETE FROM album WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        header("Location: http://localhost/app-photo-album/frontend/pages/admin.php");
        exit();
} else {
    header('location: index.php');
    exit();
}