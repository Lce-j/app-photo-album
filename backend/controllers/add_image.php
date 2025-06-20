<?php

require "../includes/database.php";

if (isset($_SESSION['user'])) {
        $path = htmlspecialchars($_POST['path']);
        $description = htmlspecialchars($_POST['description']);
        $date = htmlspecialchars($_POST['date']);
        $etiquette = htmlspecialchars($_POST['etiquette']);
        $place = htmlspecialchars($_POST['place']);
        $album = htmlspecialchars($_POST['album']);
        
        $stmt = $bdd->prepare("INSERT INTO album (id, path, description, date, etiquette, place, album) VALUES (NULL, :path, :description, :date, :etiquette, :place, :album)");
        $stmt->bindParam(':path', $path, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':etiquette', $etiquette, PDO::PARAM_STR);
        $stmt->bindParam(':place', $place, PDO::PARAM_STR);
        $stmt->bindParam(':album', $album, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'La photo a bien été ajouté!';
            // header("Location: http://localhost/app-photo-album/frontend/pages/albums/edit_album.html");
            exit();
        }
    }