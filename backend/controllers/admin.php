<?php

//voir son nombre d'album, album partagé
//create user

// session_start();

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['is_admin'] == true) {
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
    } else {
        // REDIRECTION VERS PAGE D'ACCUEIL SI PAS LES PERMS
        header("Location: http://localhost/app-photo-album/frontend/pages/dashboard.php");
        exit;
    }
} else {
    // REDIRECTION VERS PAGE D'ACCUEIL SI PAS DE SESSION
    header("Location: http://localhost/app-photo-album/");
    exit;
}


//delete user
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] == 1) {
        if (isset($delete_button)) {
            $stmt = $bdd->prepare('DELETE FROM user WHERE id = :id');
            $stmt->bindParam(':id', $id);
            // $stmt->bindValue(':id', $id);
            $stmt->execute();
        }
        header("Location: http://localhost/app-photo-album/frontend/pages/admin.php");
        exit();
    } else {
        header('location: index.php');
        exit();
    }
    
} else {
    header('location: index.php');
    exit();
}