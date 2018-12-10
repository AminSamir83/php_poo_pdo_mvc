<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 05/12/2018
 * Time: 05:15
 */
session_start();
require '../autoload.php';

if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};

$event = new Evenement();

$event->deleteEvent($_GET['id']);

header("location: ../listerEvenements.php");
?>