<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 05/12/2018
 * Time: 06:03
 */
session_start();
require 'autoload.php';

if (!isset($_SESSION['id'])) { header("Location: login.php");};

$userevent= new UserEvent();
$events= $userevent->findEventsParticipe($_SESSION['id']);




?>
<html>
<head>
    <title>Liste de mes événements</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand navbar-left" href="#">GoMyCode Events</a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>
</header>
<span style="display:block;text-align: center;color: green;font-size:larger ">Liste de mes événements</span><br><br>
<table  class = "table" style="margin-left:auto;margin-right:auto;display:block;width:100%;">
    <thead class="thead-dark">
    <tr>
        <th>
            ID
        </th>
        <th>
            Nom de l'évenement
        </th>
        <th>
            Date du début
        </th>
        <th>
            Date de la fin
        </th>
        <th>
            Emplacement
        </th>
        <th>
            Nombre de places totales
        </th>
        <th>
            Nombre de place restantes
        </th>
        <th>
            Particpation Validée
        </th>

    </tr>
    </thead>



    <?php foreach ($events as $event) { ?>
        <tr>
            <td>
                <?= $event->id_event ?>
            </td>
            <td>
                <?= $event->nom ?>
            </td>
            <td>
                <?= $event->date_debut ?>
            </td>
            <td>
                <?= $event->date_fin ?>
            </td>
            <td>
                <?= $event->emplacement ?>
            </td>
            <td>
                <?= $event->places_total ?>
            </td>
            <td>
                <?= $event->places_rest ?>
            </td>

            <td>
                <?php  if ($event->valide) {echo "Oui";} else {echo "En attente de validation";}?>
            </td>

        </tr>
    <?php } ?>
</table>


</body>
</html>