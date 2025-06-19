<?php

require "C:\wamp64\www\app-photo-album\Back\Include\database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];

    if(empty($_POST['path'])){
        $errors['path'] = 'une photo est obligatoire';
    }
}