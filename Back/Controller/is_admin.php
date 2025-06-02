<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] == 1) {
        // TODO: ACTION DE LA PAGE ADMIN
        
    } else {
        // REDIRECTION VERS PAGE D'ACCUEIL SI PAS LES PERMS
        header('location:controllers/home_controller.php');
        exit;
    }

} else {
    // REDIRECTION VERS PAGE D'ACCUEIL SI PAS DE SESSION
    header('location:controllers/home_controller.php');
    exit;
}
