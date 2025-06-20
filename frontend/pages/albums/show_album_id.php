<?php
session_start();
require_once('../../../backend/includes/database.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content=""width=device-width, initial-scale="1">
    <title>Album Photo | Tableau de bord</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
    <header id="header">
      <nav id="navbar">
        <div class="navbar__logo">
          <img id="logo" src="../../../public/images/logo_album_photo.png" width="50px" height="50px">    
          <h1 id="title">Albopho</h1>
        </div>
        <!-- <ul class="navbar__login">
          <li>
            <a href="./frontend/pages/signup.html">
               <button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i> Deconnexion</button>
            </a>
          </li>
        </ul> -->
      </nav>
    </header>
    <main>
      <?php 
      $album = $bdd->query('SELECT * FROM album');
      $photo = $bdd->query('SELECT * From photo WHERE album_id = album.id');
      ?>
      <button>Modifier</button>
      <button>Supprimer</button>
      <h3><?php echo $album['title'];?> </h3>
      <h4><?php echo $album['date']?></h4>
      <h4><?php echo $photo['place'];?></h4>
        <button hrf="./partager.html" id="share">Partager</button>
      </div>
      <div class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Partager</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>A qui voulez vous partager cette album ?</p>
              <input id="email">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Partager</button>
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