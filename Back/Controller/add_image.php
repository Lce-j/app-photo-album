<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];

    if(empty($_POST['path'])){
        $errors['path'] = 'une photo est obligatoire';
    }
}