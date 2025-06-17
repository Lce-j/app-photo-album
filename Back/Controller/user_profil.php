<?php

require "C:\wamp64\www\app-photo-album\Back\Include\database.php";

//nombre d'album, avec qui il est partager
//modifier profil
 $id_utilisateur = 1;

// Modifier les infos si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $update = $pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ? WHERE id = ?");
    $update->execute([$nom, $prenom, $id_utilisateur]);
    echo "<p style='color:green;'>Profil mis à jour.</p>";
}

// Récupérer les infos utilisateur
$stmt = $pdo->prepare("SELECT nom, prenom FROM utilisateurs WHERE id = ?");
$stmt->execute([$id_utilisateur]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM albums WHERE proprietaire_id = ?");
$stmt->execute([$id_utilisateur]);
$nb_crees = $stmt->fetchColumn();

// Nombre d'albums partagés à d'autres utilisateurs
$stmt = $pdo->prepare("
    SELECT COUNT(DISTINCT p.album_id)
    FROM partages p
    JOIN albums a ON a.id = p.album_id
    WHERE a.proprietaire_id = ?");
$stmt->execute([$id_utilisateur]);
$nb_partages = $stmt->fetchColumn();