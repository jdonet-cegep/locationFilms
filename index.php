<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['authenticated']) || isset($_GET["error"])) {
    header('Location: login.php');
    exit;
}
require_once 'Model.php';

$films = getFilmList(); // Récupération de la liste des films
$clients = getClientList(); // Récupération de la liste des clients
$title = "";

if (isset($_POST["film"])) {
    $filmId = $_POST["film"];
    $locations = getLocationsByFilm($filmId);
    $title = "Locations du film " . $filmId;
} elseif (isset($_POST["client"])) {
    $clientId = $_POST["client"];
    $locations = getLocationsByClient($clientId);
    $title = "Locations du client " . $clientId;
} else {
    // Afficher une vue par défaut ici si nécessaire.
}

if(isset($_GET["url"]) && $_GET["url"] === "form"){
    $locations = getLocationList(); // Récupération de la liste des locations
    require 'View_form.php';
} 
else
    require 'View.php';
?>
