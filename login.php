<?php
session_start(); // Démarrez la session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez les informations d'authentification
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    try {
        $dsn = "mysql:host=localhost;dbname=locationfilms;charset=UTF8";
        $conn = new PDO($dsn, $username, $password);
        // Authentification réussie, enregistrez les informations de session
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        //require_once 'index.php';
        header('Location: index.php');
    } catch (PDOException $e) {
        // Affichez un message d'erreur personnalisé
        $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
        require 'View_connexion.php';
    }
}else{
    require 'View_connexion.php';
}
?>
