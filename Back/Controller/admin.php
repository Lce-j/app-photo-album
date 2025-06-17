<?php

//voir son nombre d'album, album partagé
//create user

// session_start();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['is_admin'] == true) {

        define('AUTHORIZED_IMAGES', ['image/png', 'image/jpeg']);
        define('IMAGES_PATH', '/facebook/data/images/');

        if (count($_POST) > 0 && $_SESSION['token'] == $_POST['token']) {
            // TODO: CREATION UTILISATEUR
            
            if (isset($_SESSION['token'])) {
                unset($_SESSION['token']);
            }

            foreach ($_POST as $data) {
                if (strlen($data) === 0) {
                    echo "Veuillez renseigner tous les champs";
                    exit;
                }
            }

            if (filter_var($_POST['email'] === false)) {
                echo "Email est invalide";
                exit;
            } else if (strlen($_POST["password"]) < 8) {
                echo "Mot de passe doit faire au moins 8 caractères";
                exit;
            } else if (!isset($_FILES['avatar'])) {
                echo "Veuillez renseigner un avatar";
                exit;
            }

            if ($_POST['password'] !== $_POST['password_conf']) {
                echo "les mots de passe sont différents";
                exit;
            }

            if ($_FILES['avatar']['error'] == 0 and $_FILES['avatar']['size'] <= 200 * 1024 and in_array($_FILES['avatar']['type'], AUTHORIZED_IMAGES)) {

                $dirpath = realpath(dirname(getcwd()));
                $imageExtension = explode('/', $_FILES['avatar']['type'])[1];
                $imagePath = time() . '-' . basename(substr($_FILES['avatar']['name'], 0, 10) . '.' . $imageExtension);

                move_uploaded_file($_FILES['avatar']['tmp_name'], $dirpath . IMAGES_PATH . $imagePath);
            } else {
                echo "Image incorrecte";
                exit;
            }

            $query = 'INSERT INTO users (id, first_name, last_name, email, password, avatar, birthday, promo_id, is_admin) VALUES (NULL, :first_name, :last_name, :email, :password, :avatar, :birthday, :promo_id, :is_admin)';
            $response = $bdd->prepare($query);
            $response->execute([
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'avatar' => $imagePath,
                'birthday' => $_POST['birthday'],
                'promo_id' => $_POST['promo_id'],
                'is_admin' => false
            ]);

            header('location: index.php?page=admin_create_user');
            exit;
        } else {
            

            $query = "SELECT id, name, date FROM promo";
            $response = $bdd->query($query);
            $promotions = $response->fetchAll();
        }

    } else {
        // REDIRECTION VERS PAGE D'ACCUEIL SI PAS LES PERMS
        header('location: index.php?page=home');
        exit;
    }
} else {
    // REDIRECTION VERS PAGE D'ACCUEIL SI PAS DE SESSION
    header('location: index.php?page=home');
    exit;
}

require './views/admin_create_user.phtml';




//delete user
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] == 1) {
        $query = 'DELETE FROM users WHERE id=:user_id';
        $response = $bdd->prepare($query);
        $response->execute([
            'user_id' => $_GET['idUserDisplay']
        ]);
    
        header('location: index.php');
        exit();
    } else {
        header('location: index.php');
        exit();
    }
    
} else {
    header('location: index.php');
    exit();
}