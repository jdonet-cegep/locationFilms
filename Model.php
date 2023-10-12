<?php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    try {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $dsn = "mysql:host=localhost;dbname=locationfilms;charset=UTF8";
        $connexion = new PDO($dsn, $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
            require 'View_connexion.php';
    }

    function getFilmList() {
        global $connexion;
        $query = "SELECT * FROM film ORDER by nomFilm";
        try {
            return $connexion->query($query)->fetchAll();
        } catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function getClientList() {
        global $connexion;
        $query = "SELECT * FROM client ORDER by nomClient";
        try {
            return $connexion->query($query)->fetchAll();
        } catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function getLocationList() {
        global $connexion;
        $query = "SELECT * FROM location JOIN client ON refClient=idClient JOIN film on refFilm=idFilm";
        try {
            return $connexion->query($query)->fetchAll();
        } catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function getLocationsByFilm($filmId) {
        global $connexion;
        $query = "SELECT * FROM location, client, film WHERE idClient=refClient AND idFilm=refFilm AND refFilm=:film";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':film', $filmId);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function getLocationsByClient($clientId) {
        global $connexion;
        $query = "SELECT * FROM location, client, film WHERE idClient=refClient AND idFilm=refFilm AND refClient=:client";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':client', $clientId);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Affichez un message d'erreur personnalisé
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function insertLocation($refFilm, $refClient, $dateLocation, $dureeLocation) {
        global $connexion;
        try {
            $query = "INSERT INTO location (refFilm, refClient, dateLocation, dureeLocation) VALUES (:refFilm, :refClient, :dateLocation, :dureeLocation)";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':refFilm', $refFilm);
            $stmt->bindParam(':refClient', $refClient);
            $stmt->bindParam(':dateLocation', $dateLocation);
            $stmt->bindParam(':dureeLocation', $dureeLocation);
            return $stmt->execute();
        } catch (PDOException $e) {
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }

    function updateLocation($refFilm, $refClient, $dateLocation, $dureeLocation) {
        global $connexion;
        try {
            $query = "UPDATE location SET dateLocation = :dateLocation, dureeLocation = :dureeLocation WHERE refFilm = :refFilm AND refClient = :refClient";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':refFilm', $refFilm);
            $stmt->bindParam(':refClient', $refClient);
            $stmt->bindParam(':dateLocation', $dateLocation);
            $stmt->bindParam(':dureeLocation', $dureeLocation);
            return $stmt->execute();
        } catch (PDOException $e) {
            $error_message = 'Problème de permission utilisateur '.$e->getMessage();
            require 'View_connexion.php';
            exit;
        }
    }
}
?>
