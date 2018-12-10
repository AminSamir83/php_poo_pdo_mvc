<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 15:14
 */
session_start();
 if (isset($_SESSION['error'])) { echo "<div class='alert alert-danger container'>".$_SESSION['error']."</div><br>";}
if (isset($_SESSION['id'])) { header("Location: accessdenied.php");};
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Authentification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="color:white;background-image: url(images/bg.png)">
<div style="display:block;margin:auto;width:50%">
<form method="post" action="traitement/checklogin.php">
    <div>
        <div><div style="width:50%;display:inline-block;">Login</div> <input type="text" name="login"></div>
        <div><div style="width:50%;display:inline-block;">Password</div><input type="password" name="password"></div>
        <div div style="width:50%;display:block;margin-right:auto;margin-left:auto"><input type="submit" class="btn btn-light" value="Se Connecter">
            <a  class="btn btn-light" style="color:black" href="ajouterUtilisateur.php">S'enregistrer</a>
        </div>
    </div>
</form>
</div>

</body>