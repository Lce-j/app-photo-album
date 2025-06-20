<?php 
session_start();
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content=""width=device-width, initial-scale="1">
        <title>Album Photo | Espace Administrateur</title>
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="module" src="../assets/js/main.js"></script>
    </head>
    <body>
        <header id="header">
            <nav id="navbar">
                <div class="navbar__logo">
                    <img id="logo" src="../../public/images/logo_album_photo.png" width="50px" height="50px"></img>
                    <h1 id="title">Albopho</h1>
                </div>
                <ul class="navbar__login">
                    <!-- <li>
                        <?php if ($user['is_admin'] === 1) { echo "<a href=''>Espace administrateur</a>"; } ?>
                    </li> -->
                    <li src="../pages/dashboard.php">
                        <button type="submit" class="btn btn-primary" name="update-profil">Retour sur dashboard</button> 
                    </li>
                    <li>
                        <button onclick="<?php session_destroy() ?>" id="btn-login" type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i> Deconnexion</button>
                    </li>
                </ul>
            </nav>
        </header>
        <main id="admin">
            <div id="tableau">
                <h3>Listes des utilisateurs</h3>
                <ul id="users">
                    <li>
                        <?php echo $user['last_name'] . $user['first_name']; ?>
                        <button type="submit" class="btn btn-danger" name="delete-profil">Supprimer l'utilisateur</button>
                        <button type="submit" class="btn btn-primary" name="update-profil">Voir le profil</button>
                    </li>
                </ul>
            </div>
        </main>
        <footer id="footer">
            <a href="http://" target="_blank" rel="noopener noreferrer">Projet de fin d'année</a>
            <a href="http://" target="_blank" rel="noopener noreferrer">&copy; Lucie Josse | 2024-2025</a>
        </footer>
    </body>
</html>