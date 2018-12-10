<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 05/12/2018
 * Time: 04:40
 */
session_start();


require 'autoload.php';

if (!isset($_SESSION['id'])) { header("Location: login.php");};
if ($_SESSION['role']!=='Admin') {header  ('Location : accessdenied.php');};

$event=new Evenement();
$evenement= $event->findById($_GET['id']);






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
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
<?php
$ancient=$_GET['id'];
if (isset($_SESSION['error_date'])){
    ?>
    <div class="container">
        <div class="alert alert-danger" style="margin: 0 !important;"><?= $_SESSION['error_date'] ?></div></div>
    <?php
    unset($_SESSION['error_date']);
}





?>
<?php if (isset($_SESSION['error_nbr'])){
    ?>
    <div class="container">
        <div class="alert alert-danger" style="margin: 0 !important;"><?= $_SESSION['error_nbr'] ?></div></div>
    <?php
    unset($_SESSION['error_nbr']);
}




?>


<form method="GET" action="traitement/miseAJourEvenement.php" >
    <span style="display:block;text-align: center;color: darkblue;font-size:larger ">Mettre à jour un événement</span><br><br>
    <table table class = "table" style="margin-left:auto;margin-right:auto;display:block;width:30%;">
        <tr><td><label for="id_event">ID </label></td><td><input class="form-control enter-text" type="number" required name="id_event" id="id_event"  readonly value="<?= $evenement->id_event ?>"></td></tr>
        <tr><td><label for="nom">Nom </label></td><td><input type="text" class="form-control enter-text" required  maxlength="30" name="nom" id="nom" value="<?= $evenement->nom ?>""> </td></tr>
        <tr><td><label for="date_debut">Date du début </label></td><td><input type="date" required class="form-control enter-text" name="date_debut"   id="date_debut" value="<?= $evenement->date_debut ?>"></td></tr>
        <tr><td><label for="date_fin">Date de fin </label></td><td><input type="date" required class="form-control enter-text" name="date_fin" id="date_fin" value="<?= $evenement->date_fin ?>"></td></tr>
        <tr><td><label for="emplacement">Emplacement</label></td><td><input type="text" required class="form-control enter-text" name="emplacement" id="emplacement" maxlength="30" value="<?= $evenement->emplacement ?>"></td></tr>
        <tr><td><label for="places_total">Nombre de places totales: </label></td><td><input class="form-control enter-text" type="number" required name="places_total" id="places-total" min="1" value="<?= $evenement->places_total ?>"></td></tr>
        <tr><td><label for="places_rest">Nombre de places restantes: </label></td><td><input readonly class="form-control enter-text" type="number" required name="places_rest" id="places-rest" min="0" value="<?= $evenement->places_rest ?>"></td></tr>
    </table>
    <input class="btn btn-primary" type="submit" id="button-send" style="margin-left:auto;margin-right:auto;display:block;width:20%;" id="button-send" value="Mettre à jour" href='miseAJourEvenement.php?id=<?= $ancient ?>' >


</form>

</body>
</html>