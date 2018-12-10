<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 04/12/2018
 * Time: 05:21
 */

session_start();
require '../autoload.php';
if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};

if ((preg_match('~[0-9]~', $_POST['nom']))  || (preg_match('~[0-9]~', $_POST['prenom'])))
{

    $_SESSION['error_number'] = "Le nom et le prénom ne doivent pas contenir de nombres";
    header("Location: ../mettreAJourUtilisateur.php?id=".$_POST['id_user'] );
    exit();
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_mail'] = "Veuillez insérer un Email valide";
    header("Location: ../mettreAJourUtilisateur.php?id=".$_POST['id_user'] );
    exit();
}
$user = new Utilisateur();

$user->updatePersonne($_POST['id_user'], $_POST['prenom'], $_POST['nom'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['cin'], $_POST['telephone'], $_POST['ville'], $_POST['code_postal'],$_POST['role']);


header("location: ../listerUtilisateurs.php");