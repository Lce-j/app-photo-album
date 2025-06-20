<?php 
session_start();
$user = $_SESSION['user'] ?? null;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content=""width=device-width, initial-scale="1">
        <title>Album Photo | Tableau de bord</title>
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
                    <li>
                        <?php if ($user['is_admin'] === 1) { echo "<a href='./admin.php'>Espace administrateur</a>"; } ?>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa-solid fa-gear"></i></button>
                    </li>
                    <li>
                        <button onclick="<?php session_destroy() ?>" id="btn-login" type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                    </li>
                </ul>
            </nav>
        </header>
        <main id="dashboard">
            <div>
                <h3>
                    <?php 
                        if (isset($user['last_name'], $user['first_name'])) {
                            echo 'Bonjour et bienvenue ' . htmlspecialchars($user['last_name']) . ' ' . htmlspecialchars($user['first_name']);
                        } else {
                            echo 'Bonjour invité';
                        }
                    ?>
                </h3>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifié Profil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../../backend/controllers/user_profil.php" method="post">
                                <div class="mb-3">
                                    <label for="first-name" class="col-form-label">Prénom</label>
                                    <input type="text" class="form-control" id="first-name" name="first-name">
                                </div>
                                <div class="mb-3">
                                    <label for="last-name" class="col-form-label">Nom de famille</label>
                                    <input  type="text" class="form-control" id="last-name" name="last-name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="text"  class="form-control" id="email" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label">Mot de passe</label>
                                    <input type="text"  class="form-control" id="password" name="password">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="delete-profil">Supprimer mon compte</button>
                                    <button type="submit" class="btn btn-primary" name="update-profil">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer">
            <a href="http://" target="_blank" rel="noopener noreferrer">Projet de fin d'année</a>
            <a href="http://" target="_blank" rel="noopener noreferrer">&copy; Lucie Josse | 2024-2025</a>
        </footer>
    </body>
</html>