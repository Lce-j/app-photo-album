<?php

require "C:\wamp64\www\app-photo-album\Back\Include\database.php";

$stmt = $pdo->prepare("SELECT id FROM user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($utilisateur) {
    $id_user = $user['id'];
    $check = $pdo->prepare("SELECT * FROM partages WHERE album_id = ? AND user_id = ?");
    $check->execute([$id_album, $user_id]);

    if ($check->rowCount() === 0) {
        $insert = $pdo->prepare("INSERT INTO partages (album_id, user_id) VALUES (?, ?)");
        $insert->execute([$id_album, $user_id]);
        echo "Album partagé avec succès avec $email";
    } else {
        echo "Album déjà partagé avec cet utilisateur.";
    }
} else {
    echo "Utilisateur non trouvé.";
}