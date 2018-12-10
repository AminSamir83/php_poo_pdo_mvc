<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 05/12/2018
 * Time: 04:47
 */
session_start();
require '../autoload.php';

if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};

$date_now = new DateTime();
$date_debut  = $_GET['date_debut'];
$date_fin = $_GET['date_fin'];

if($date_fin<$date_debut)
{
    $_SESSION['error_date'].=" La date de fin doit être supérieure à la date courante ";
    header ('Location: ../mettreAJourEvenement.php?id='.$_GET['id_event']);
    die();
}


$event= new Evenement();



$nombre = $event->findParticipantsNumber($_GET['id_event']);

$nbr= (int)$nombre->NBR;


if ($nbr >(int)($_GET['places_total']))
{
    $_SESSION['error_nbr'].= " Le nombre de places total doit être supérier au nombre de réservations validées ";
    header ('Location: ../mettreAJourEvenement.php?id='.$_GET['id_event']);
    die();
}

$places_rest= (int)$_GET['places_total']-$nbr;

$event->updateEvent($_GET['id_event'],$_GET['nom'],$_GET['date_debut'],$_GET['date_fin'],$_GET['emplacement'],$_GET['places_total'],"".$places_rest);



header("location: ../listerEvenements.php");