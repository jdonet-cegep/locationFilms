<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Location</title>
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
        function preSelect(){
            let index= document.getElementById('location').selectedIndex
            document.getElementById('dateLocationUpdate').value = document.getElementById('date['+index+']').value
            document.getElementById('dureeLocationUpdate').value = document.getElementById('duree['+index+']').value
            document.getElementById('refClientUpdate').value = document.getElementById('client['+index+']').value
            document.getElementById('refFilmUpdate').value = document.getElementById('film['+index+']').value

        }
    </script>
</head>
<body>
    <a href="logout.php">Se déconnecter</a>
    <div class="container">
        <h1>Formulaire de Location</h1>
        <div class="row">
            <div class="col">
                Voir uniquement les
                <input type="radio" name="voirQui" value="insert" onChange="afficherDiv('insert');masquerDiv('update');" checked>Insertion de location 
                <input type="radio" name="voirQui" value="update"  onChange="afficherDiv('update');masquerDiv('insert');">Mise à jour de location
            </div>
        </div>
        <div id="insert">
            <h2>Insertion</h2>
            <form method="POST" action="process_location.php">
                <label for="exampleSelect1">Films</label>
                <select class="form-control" name="filmInsert">
                    <?php
                    foreach ($films as $film) {
                        echo '<option value="' . $film['idFilm'] . '">' . $film['nomFilm'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-group">
                    <label for="exampleSelect1">Clients</label>
                    <select class="form-control" name="clientInsert">
                        <?php
                        foreach ($clients as $client) {
                            echo '<option value="' . $client['idClient'] . '">' . $client['nomClient'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dateLocationInsert">Date de Location</label>
                    <input type="date" class="form-control" name="dateLocationInsert" id="dateLocationInsert">
                </div>
                <div class="form-group">
                    <label for="dureeLocationInsert">Durée de Location (nb jours)</label>
                    <input type="number" class="form-control" name="dureeLocationInsert" id="dureeLocationInsert" max=127>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
        <div id="update">
            <h2>Mise à jour</h2>
            <form method="POST" action="process_location.php">
                <label for="exampleSelect1">Locations</label>
                <input type ="hidden" id="refFilmUpdate" name="refFilmUpdate" value="<?=$locations[0]['idFilm']?>">
                <input type ="hidden" id="refClientUpdate" name="refClientUpdate" value="<?=$locations[0]['idClient']?>">

                <?php
                $i=0;
                foreach ($locations as $location) {             
                    echo '<input disabled type ="hidden" id=date['.$i.'] value="' . $location['dateLocation'] . '">';
                    echo '<input disabled type ="hidden" id=duree['.$i.'] value="' . $location['dureeLocation'] . '">';
                    echo '<input disabled type ="hidden" id=film['.$i.'] value="' . $location['idFilm'] . '">';
                    echo '<input disabled type ="hidden" id=client['.$i.'] value="' . $location['idClient'] . '">';
                    $i++;
                }
                ?>
            
                <select class="form-control" name="location" id="location" onchange="preSelect()">
                    <?php
                    foreach ($locations as $location) { 
                        echo '<option value="' . $location['idClient'] . '-' . $location['idFilm'] . '">' . $location['nomFilm'] . ' / ' . $location['nomClient'] . ' : ' . $location['dateLocation'] . ' pour ' . $location['dureeLocation'] . ' jour(s)</option>';
                    }
                    ?>
                </select>
                <div class="form-group">
                    <label for="dateLocationUpdate">Date de Location</label>
                    <input type="date" class="form-control" name="dateLocationUpdate" id="dateLocationUpdate">
                </div>
                <div class="form-group">
                    <label for="dureeLocationUpdate">Durée de Location (nb jours)</label>
                    <input type="number" class="form-control" name="dureeLocationUpdate" id="dureeLocationUpdate" max=127>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
        <script>
        document.getElementById("update").style.display = "none"; 
    </script>
    </div>
</body>
</html>
