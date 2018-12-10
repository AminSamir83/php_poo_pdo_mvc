<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 05/12/2018
 * Time: 04:13
 */
session_start();
require '../autoload.php';
if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};

$date_now = date("Y-m-d");

$date_debut    = $_POST['date_debut'];

$date_fin = $_POST['date_fin'];

if ($date_now > $date_debut==true) {
    $_SESSION['error_date'].=" La date du début doit être supérieure à la date courante ";
    header ('Location: ../ajouterEvenement.php');
    die();
}
if($date_fin<$date_debut)
{
    $_SESSION['error_date'].=" La date de fin doit être supérieure à la date courante ";
    header ('Location: ../ajouterEvenement.php');
    die();
}
if ($date_fin<$date_now)
{
    $_SESSION['error_date'].= " La date de fin doit être supérieure à la date courante ";
    header ('Location: ../ajouterEvenement.php');
    die();
}

$evenement = new Evenement();

$evenement->addEvent( $_POST['nom'], $_POST['date_debut'], $_POST['date_fin'], $_POST['emplacement'], $_POST['places_total']);





header("location: ../listerEvenements.php");