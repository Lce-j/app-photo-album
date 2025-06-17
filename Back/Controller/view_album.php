<?php
define('IMAGES_PATH', '/app-photo/data/images/');


$has_liked = null;

if (isset($_SESSION['user'])) {

    $trie = (isset($_GET['trie']) ? $_GET['trie'] : 'last_name');
    $sens = (isset($_GET['sens']) ? $_GET['sens'] : 'ASC');

    // Select all users from a promo and count the number of likes for each user + check if the current user has liked the user
    $query = "SELECT u.first_name, u.last_name, u.email, u.id, u.birthday, u.avatar, p.id AS promo_id, p.name, count(l.id) AS total_likes, (SELECT count(l.id) FROM likes AS l WHERE l.liked_id=u.id AND l.user_id=:user_id) AS has_liked 
    FROM users AS u 
    INNER JOIN user AS p ON u.promo_id=:promo_id 
    LEFT JOIN likes AS l ON l.liked_id=u.id
    GROUP BY u.id
    ORDER BY " . $trie . " " . $sens;

    $response = $bdd->prepare($query);
    $response->execute([
        'promo_id' => $_GET['idPromo'],
        'user_id' => $_SESSION['user']['id'],
    ]);
    $users = $response->fetchAll();

    if (isset($_POST['target_id'])) {
        if (count($users) > 0) {
            foreach ($users as $data) {
                if ($data['id'] == $_POST['target_id']) {
                    $has_liked = $data['has_liked'] > 0;
                }
            }
        }

        if ($has_liked) {
            $query = 'DELETE FROM likes WHERE user_id=:user_id AND liked_id=:liked_id';
            $response = $bdd->prepare($query);
            $response->execute([
                'user_id' => $_SESSION['user']['id'],
                'liked_id' => $_POST['target_id']
            ]);
        } else {
            if ($_POST['target_id'] != $_SESSION['user']['id']) {
                $query = 'INSERT INTO likes (id, user_id, liked_id) VALUES (NULL, :user_id, :liked_id)';
                $response = $bdd->prepare($query);
                $response->execute([
                    'user_id' => $_SESSION['user']['id'],
                    'liked_id' => $_POST['target_id']
                ]);
            } else {
                echo "Vous ne pouvez pas vous liker vous même";
            }
        }
        $idPromo = isset($_GET['idPromo']) ? $_GET['idPromo'] : '';
        $trie = isset($_GET['trie']) ? $_GET['trie'] : '';
        $sens = isset($_GET['sens']) ? $_GET['sens'] : '';
        
        $location = 'index.php?page=promo_display&idPromo=' . $idPromo;
        if (!empty($trie)) {
            $location .= '&trie=' . $trie;
        }
        if (!empty($sens)) {
            $location .= '&sens=' . $sens;
        }
        
        header('Location: ' . $location);
        exit();
    }

} else {


    $trie = (isset($_GET['trie']) ? $_GET['trie'] : 'last_name');
    $sens = (isset($_GET['sens']) ? $_GET['sens'] : 'ASC');
    
    // Select all users from a promo and count the number of likes for each user
    $query = "SELECT u.first_name, u.last_name, u.email, u.id, u.birthday, u.avatar, p.id AS promo_id, p.name, count(l.id) AS total_likes 
    FROM users AS u 
    INNER JOIN promo AS p ON u.promo_id=:promo_id 
    LEFT JOIN likes AS l ON l.liked_id=u.id 
    GROUP BY u.id
    ORDER BY " . $trie . " " . $sens;

    $response = $bdd->prepare($query);
    $response->execute([
        'promo_id' => $_GET['idPromo'],
    ]);
    $users = $response->fetchAll();
}

$promo_name = null;
if (count($users) > 0) {
    foreach ($users as $data) {
        if ($data['promo_id'] == $_GET['idPromo']) {
            $promo_name = $data['name'];
        }
    }
}

$query = 'SELECT name
    FROM promo
    WHERE promo.id = ' . $_GET['idPromo'];

$response = $bdd->prepare($query);
$response->execute();
$namePromo = $response->fetchAll();
$response->closeCursor();

$promo_name = $namePromo[0]['name'];
require "./views/promo.phtml";