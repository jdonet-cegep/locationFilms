<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit;
}

require_once 'Model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['filmInsert']) && isset($_POST['clientInsert']) && isset($_POST['dateLocationInsert']) && isset($_POST['dureeLocationInsert'])) {
        $filmId = $_POST['filmInsert'];
        $clientId = $_POST['clientInsert'];
        $dateLocation = $_POST['dateLocationInsert'];
        $dureeLocation = $_POST['dureeLocationInsert'];;
        $success = insertLocation($filmId, $clientId, $dateLocation, $dureeLocation);

    } elseif (isset($_POST['dateLocationUpdate']) && isset($_POST['dureeLocationUpdate']) && isset($_POST['refClientUpdate']) && isset($_POST['refFilmUpdate'])) {
        $dateLocation = $_POST['dateLocationUpdate'];
        $dureeLocation = $_POST['dureeLocationUpdate'];
        $refClient = $_POST['refClientUpdate'];
        $refFilm = $_POST['refFilmUpdate'];

        $success = updateLocation($refFilm, $refClient, $dateLocation, $dureeLocation);

    }

    if ($success) {
        // Rediriger vers la page principale avec un message de succès
        header('Location: index.php?success=true');
    } else {
        // En cas d'erreur, affichez un message d'erreur . On devrait pas y passer, sinon soucis
        header('Location: index.php?error=true');
    }
}
?>
