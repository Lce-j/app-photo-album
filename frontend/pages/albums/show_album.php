<?php
session_start();
require_once('../../../backend/includes/database.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="" width="device-width," initial-scale="1" />
    <title>Album Photo | Accueil</title>
    <link rel="stylesheet" href="../../assets/css/styles.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script
      defer
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
      integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
  </head>
  <body>
    <header id="header">
      <nav id="navbar">
        <div class="navbar__logo">
          <img
            id="logo"
            src="../../../public/images/logo_album_photo.png"
            width="50px"
            height="50px"
          />
          <h1 id="title">Albopho</h1>
        </div>
        <ul class="navbar__login">
          <li>
            <a href="../signup.html">
              <button type="button" class="btn btn-primary">
                <i class="fa-solid fa-user"></i>
              </button>
            </a>
          </li>
        </ul>
      </nav>
    </header>
    <main id="album">
      <?php
        $stmt = $bdd->query('SELECT * FROM album');
        foreach ($stmt as $album) { ?>
          <div class="card" style="width: 18rem;">
            <img src="#" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $album['title'];?> 
              </h5>
              <p class="card-text"><?php echo $album['date']?></p>
              <a href="http://localhost/app-photo-album/frontend/pages/albums/show_album_id.php" class="btn btn-primary" >Voir</a>
            </div>
            <!-- <?php echo $album['id'];?> -->
          </div>
       <?php }?> 
    </main>
    <footer id="footer">
      <a
        href="https://github.com/Lce-j/app-photo-album"
        target="_blank"
        rel="noopener noreferrer"
        >Projet de fin d'année</a
      >
      <a
        href="https://linkedin.com/in/josse-lucie"
        target="_blank"
        rel="noopener noreferrer"
        >&copy; Lucie Josse | 2024-2025</a
      >
    </footer>
  </body>
</html>
