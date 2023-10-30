<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calcul Abonnement</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <?php

        // réinitialisation du formulaire
        include 'fonctions.php';
        if (isset($_GET['reset'])){
            $nbAdherents = null;
            $nbSections = null;
            $federation = null;
        }

        // initialisation des variables
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nbAdherents = $_POST['nbAdherents'];
            $nbSections = $_POST['nbSections'];
            $federation = $_POST['federation'];
        }else{
            $nbAdherents = null;
            $nbSections = null;
            $federation = null;
        } 
    ?>
    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center ">
        <div class="row">
            <h1 class="text-center mb-4">Calcul Abonnement</h1>
        </div>    
        <div class="col-6">
            <div class="row mb-5">  
                <!-- Formulaire de saisie des données -->
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nbAdherents" class="form-label">Nombre d'adherents</label>
                        <input type="number" class="form-control" name="nbAdherents" id="nbAdherents" value="<?= isset($nbAdherents)? $nbAdherents : '0'?>">
                    </div>   
                    <div class="mb-3">
                        <label for="nbSections" class="form-label">Nombre de Sections</label>
                        <input type="number" class="form-control" name="nbSections" id="nbSections" value="<?= isset($nbSections)? $nbSections : '0'?>">
                    </div>   
                    <div class="mb-3">
                        <label for="federation" class="form-label">Fédération</label>
                        <select name="federation" id="federation" class="form-select">
                            <option value="">-- Sélectionnez votre fédération --</option>
                            <option value="N" <?= $federation == 'N' ? 'selected' : '' ?>>Natation</option>
                            <option value="G" <?= $federation == 'G' ? 'selected' : '' ?>>Gymnastique</option>
                            <option value="B" <?= $federation == 'B' ? 'selected' : '' ?>>Basketball</option>
                            <option value="A" <?= $federation == 'A' ? 'selected' : '' ?>>Autre fédération</option>
                        </select>
                    </div>   
                    <input type="submit" value="Calculer" class="btn btn-info">
                    <a href="?reset" class="btn btn-warning">Reset</a>
                </form>
            </div>
            <!-- Affichage du résultat -->
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                <div class="row border rounded p-2">
                    <?php $resultat = calculPrixAbonnement($nbAdherents, $nbSections, $federation); ?>
                    <p>Sous total Adhérents : <?= $resultat['prixAdherents']?> € (HT/mois)</p>
                    <p>Sous total Sections : <?= $resultat['prixSections']?> € (HT/mois)</p>
                    <p>Total Abonnement : <?= $resultat['prixAbonnement']?> € (TTC/an)</p>

                </div>
            <?php } ?>
        </div>
    </div>
            
  </body>
</html>