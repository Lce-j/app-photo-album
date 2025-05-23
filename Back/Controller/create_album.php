<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];

    if(empty($_POST['title'])){
        $errors['title'] = 'un titre est obligatoire';
    }
    if(empty($_POST['date'])){
        $errors['date'] = 'une date est obligatoire';
    }
    if(empty($_POST['place'])){
        $errors['place'] = 'un lieu est obligatoire';
    }
    if(empty($_POST['id_photo'])){
        $errors['id_photo'] = 'une photo est obligatoire';
    }

    if(count($errors) === 0){
        $querry = "INSERT INTO album(title, date, place, id_photo) VALUES (:title, :date, :place, :id_photo)";
        $response = $bdd->prepare($querry);
        $response->execute([
            ':title'=>$_POST['title'],
            ':date'=>$_POST['date'],
            ':place'=>$_POST['place'],
            ':id_photo'=>$_POST['id_photo'],
        ]);
    }
}