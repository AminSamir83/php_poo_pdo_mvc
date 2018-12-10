<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/12/2018
 * Time: 16:14
 */
session_start();
require '../autoload.php';

if (!isset($_SESSION['id'])) { header("Location: ../login.php");};


$userEvent = new UserEvent();

$userEvent->ajouterParticipation($_GET['id_event'],$_GET['id_user']);


header("location: ../listerEvenementsParticipe.php");