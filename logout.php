<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 04/12/2018
 * Time: 04:17
 */session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php");};
if (isset($_SESSION['id'])) {
    session_destroy();

}
header('Location: login.php');