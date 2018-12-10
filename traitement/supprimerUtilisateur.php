<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 04/12/2018
 * Time: 05:12
 */
session_start();
require '../autoload.php';

if (!isset($_SESSION['id'])) { header("Location: ../login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : ../accessdenied.php');};

$user = new Utilisateur();

$user->deletePersonne($_GET['id']);

header("location: ../listerUtilisateurs.php");
?>