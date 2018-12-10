<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 04/12/2018
 * Time: 04:24
 */
session_start();
require '../autoload.php';


if ((preg_match('~[0-9]~', $_POST['nom']))  || (preg_match('~[0-9]~', $_POST['prenom'])))
{

    $_SESSION['error_number'] = "Le nom et le prénom ne doivent pas contenir de nombres";
    header('Location: ../ajouterUtilisateur.php');
    exit();
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_mail'] = "Veuillez insérer un Email valide";
    header("Location: ../ajouterUtilisateur.php" );
    exit();
}

$user = new Utilisateur();
$mdp=md5($_POST['password']);
$user->addPersonne( $_POST['prenom'], $_POST['nom'], $_POST['login'], $mdp, $_POST['email'], $_POST['cin'], $_POST['telephone'], $_POST['ville'], $_POST['code_postal']);


header("location: ../listerUtilisateurs.php");
