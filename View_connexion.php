<!DOCTYPE html>
<html>
<head>
    <title>Location films</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        // langage javascript

        //premiere fonction, nom masquerDiv / zone est un parametre
        function masquerDiv(zone){
            //cache l'élément passé en paramètre
            document.getElementById(zone).style.display="none";
        }

        function afficherDiv(zone){
            //affiche l'élément passé en paramètre
            document.getElementById(zone).style.display="block";
        }
    </script>
</head>
<body>
    <h1>Formulaire de connexion</h1>
    <form method="POST" action="login.php">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
    
    <?php if (isset($error_message)): ?>
    <!-- Affichez le message d'erreur personnalisé -->
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
</form>
</body>
</html>