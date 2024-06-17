<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once '_connect.php';
        $pdo = new \PDO(DSN, USER, PASS);
        $query = "SELECT * FROM friend";
        $statement = $pdo->query($query);
        $friends = $statement->fetchAll();
    ?>    
        <ul>
        <?php foreach($friends as $character => $info): ?>
                <li><?= $info['firstname'] ." ".$info['lastname'] ?></li>
        <?php endforeach ?>
        </ul>


        <?php if(array_key_exists('errors', $_SESSION)): ?>            
            <h3> Attention ! votre formulaire ne peux pas être envoyé. </h3>
            <ul>
                <li>
                <?= implode('<li>', $_SESSION['errors']); ?>
            </ul>
        <?php unset($_SESSION['errors']); endif; ?>
        <form action="/addFriend.php" method="POST">
            <label for="firstname">prénom :</label><input type="text" id="firstname" name="firstname"/>
            <label for="lastname">nom :</label><input type="text" id="lastname" name="lastname"/>
            <input type="submit" value="envoyer">
        </form>
        </body>
</html>