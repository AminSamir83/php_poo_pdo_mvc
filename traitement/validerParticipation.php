<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/12/2018
 * Time: 16:37
 */

session_start();
require '../autoload.php';

if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};


$userEvent = new UserEvent();
$nbp=$_GET['places_rest'];
$userEvent->validerParticipation($_GET['id_event'],$_GET['id_user'],$nbp);



header("location: ../participationAValider.php");