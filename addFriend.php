<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if($_POST!=null && count($_POST)>0)
    {
        $errors = [];
        if(!array_key_exists('firstname', $_POST) || $_POST['firstname'] =='' || preg_match("/^[A-Za-z]+$/", $_POST['firstname'])<1 || strlen($_POST['firstname'])>45)
        {
            $errors['firstname'] ="Prénom requis !";
        }
        if(!array_key_exists('lastname', $_POST) || $_POST['lastname'] =='' || preg_match("/^[A-Za-z]+$/", $_POST['lastname'])<1 || strlen($_POST['lastname'])>45)
        {
            $errors['lastname'] ="Nom requis !";
        }
        if(!empty($errors))
        {
            session_start();
            $_SESSION['errors']=$errors;
            header('Location: index.php');
        }
        else
        {
            require_once '_connect.php';
            $pdo = new \PDO(DSN, USER, PASS);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);        
            $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
            $statement = $pdo->prepare($query);                    
            $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);            
            $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);            
            $statement->execute();        
            header('Refresh: 10; URL=index.php');
        }
    }
?>
    <h1>Pas de problème, on l'ajoute !</h1>

</body>
</html>
