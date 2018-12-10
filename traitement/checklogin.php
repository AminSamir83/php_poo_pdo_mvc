<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 15:21
 */
session_start();
require '../autoload.php';
// récuperer les champs
//ajouter les tests et  tout ce qu'il faut
$login= $_POST['login'];
$password= md5($_POST['password']);
// recuperer le user
$user = new Utilisateur();
// verifier s'il est dans la base
$utilisateur = $user->connect($login,$password);
// si oui
if($utilisateur[0]==='Bienvenue!') {
    $_SESSION['id'] = $utilisateur[1];
    $_SESSION['succes'] = "Bienvenue!";
    $_SESSION['role'] = $utilisateur[2];
    header('Location:../index.php');
    exit();
}
elseif ($utilisateur[0]==='Mot de passe incorrect'){
    $_SESSION['error'] = "Mot de passe incorrect";
    header('Location: ../login.php');
    exit();
} elseif($utilisateur[0]==='Utilisateur introuvable') {
    $_SESSION['error'] = "Utilisateur introuvable";
    header('Location:../login.php');
    exit();
}
