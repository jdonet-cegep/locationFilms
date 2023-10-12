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
    <a href="logout.php">Se déconnecter</a> <br> <a href="index.php?url=form">Insertion/maj</a>
    <div class="container">
        <h1>Visualisation des locations de films</h1>
        <div class="row">
            <div class="col">
                Voir uniquement les
                <input type="radio" name="voirQui" value="film" onChange="afficherDiv('film');masquerDiv('client');">Films 
                <input type="radio" name="voirQui" value="client"  onChange="afficherDiv('client');masquerDiv('film');">Clients
            </div>
        </div>
        <div class="row">
            <div class="col" id="film">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleSelect1">Films</label>
                        <select class="form-control" name="film">
                            <?php
                            foreach ($films as $film) {
                                echo '<option value="' . $film['idFilm'] . '">' . $film['nomFilm'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Voir locations</button>
                </form>
            </div>
            <div class="col" id="client">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleSelect1">Clients</label>
                        <select class="form-control" name="client">
                            <?php
                            foreach ($clients as $client) {
                                echo '<option value="' . $client['idClient'] . '">' . $client['nomClient'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Voir locations</button>
                </form>
            </div>
        </div>
        <h2><?= $title ?></h2>
        <?php
        if (isset($locations)) {
            echo '<ul class="list-group">';
            foreach ($locations as $location) {
                echo '<li class="list-group-item">' . $location['nomClient'] . " / " . $location['nomFilm'] . " le " . $location['dateLocation'] . " pour " . $location['dureeLocation'] . ' jour(s)</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
</body>
</html>
