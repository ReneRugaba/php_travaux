<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    // a partir d'ici j'ecrit dans le fichier
    if (!empty($_POST) && $_GET['action'] == 'add') { //ici je verifie que les informations que je reçoit en methode $_POST et en get add
        if (isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["dateN"]) && !empty($_POST["dateN"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
            // au dessu je verifie chaque ellement du formulaire avant d'executer plus bas
            // rien ne sera executé sans que l'ensemble des element ne soit present dans le form
            $file = fopen("data.txt", "a+"); // j'ouvre le fichier en lecture et ecfriture et j'ecris à la suite de se qui s'y trouve avec fwrite en dessous
            fwrite($file, $_POST["email"] . ";" . $_POST["nom"] . ";" . $_POST["prenom"] . ";" . $_POST["dateN"] . "\n");
            fclose($file); //je ferme le fichier txt

        }
    } elseif (isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["dateN"]) && !empty($_POST["dateN"]) && isset($_POST["email"]) && !empty($_POST["email"]) && !empty($_GET) && $_GET['action'] == 'modifier') {
        $file = fopen('data.txt', 'r');
        $chaine = fread($file, filesize('data.txt'));
        fclose($file);

        $chaineTab = explode("\n", $chaine);
        for ($i = 0; $i < count($chaineTab); $i++) {
            $mot = explode(";", $chaineTab[$i]);
            if ($_GET['id'] == $mot[0]) {
                unset($chaineTab[$i]);
                break;
            }
        }
        $file = fopen('data.txt', 'w');
        foreach ($chaineTab as $value) {
            if (!empty($value)) {
                fwrite($file, $value . "\n");
            }
        }
        fclose($file);
        $file = fopen('data.txt', 'a+');
        fwrite($file, $_POST['email'] . ";" . $_POST['nom'] . ";" . $_POST['prenom'] . ";" . $_POST['dateN']);
        fclose($file);
    }
    // a partir d'ici je delete
    elseif (!empty($_GET) && $_GET['action'] == 'delete') {
        $file = fopen('data.txt', 'r');
        $tabFile = fread($file, filesize('data.txt')); //je lis le fichier et je le met dans la variable $tabfile
        fclose($file); // je ferme le ficier

        $tabline = explode("\n", $tabFile); // je recupere dans le tableau $tabline de la variable $tabfile grace au retour à la ligne
        for ($i = 0; $i < count($tabline); $i++) { // je fait une boucle pour prendre ligne par ligne
            $tabMot = explode(";", $tabline[$i]); // je separe chaque donnée de la ligne grâce au ";"
            if ($_GET['id'] == $tabMot[0]) { // je compare id en get à chaque element se trouvant à la position 0 de chaque ligne 
                unset($tabline[$i]); //quand je trouve je supprime la ligne
                break; // j'arrete la boucle
            }
        }

        $file = fopen('data.txt', 'w'); //j'ouvre à nouveau le fichier
        foreach ($tabline as $value) { //j'ecris ligne par ligne les nouvelles données
            if (!empty($value)) { // j'evite les ligne vide en plus pour eviter des retour d'erreurs
                fwrite($file, $value . "\n"); //j'ecris sur une ligne et je passe à la ligne suivante grace \n
            }
        }
        fclose($file); //je le ferme

    } elseif (!empty($_GET) && $_GET['action'] == 'edit') {
        $file = fopen('data.txt', 'r');
        while (!feof($file)) {
            $lines = fgets($file);
            $mot = explode(';', $lines);
            if ($_GET['id'] == $mot[0]) {
    ?>
                <form action="index.php?id=<?php echo $_GET['id']; ?>&action=modifier" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input type="text" name="nom" value="<?php echo  $mot[1]; ?>" class="form-control"><br>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="prenom" value="<?php echo  $mot[2]; ?>" class="form-control"><br>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="email" name="email" value="<?php echo  $mot[0]; ?>" class="form-control"><br>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="date" name="dateN" id="dateN" value="<?php echo  $mot[3]; ?>" class="form-control"><br>
                        </div>
                        <input type="submit" class="btn btn-primary" value="soumettre" class="form-control">
                    </div>
                </form>
    <?php
            }
        }
        fclose($file);
    }
    ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">MAIL</th>
                <th scope="col">NOM</th>
                <th scope="col">PRENOM</th>
                <th scope="col">DATE DE NAISSANCE</th>
                <th scope="col">SUPPRIMER</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <?php
        $file = fopen("data.txt", "r");



        $file = fopen('data.txt', 'r');
        while (!feof($file)) {
            $line = fgets($file);
            if ($line) {
                $tabInfos = explode(";", $line);
        ?>
                <tbody>
                    <tr>
                        <td><?php echo  $tabInfos[0]; ?></td>
                        <td><?php echo  $tabInfos[1]; ?></td>
                        <td><?php echo  $tabInfos[2]; ?></td>
                        <td><?php echo  $tabInfos[3]; ?></td>
                        <td><a href="index.php?id=<?php echo  $tabInfos[0]; ?>&action=delete"><button type="button" class="btn btn-danger">X</button></a></td>
                        <td><a href="infospersos.php?id=<?php echo  $tabInfos[0]; ?>&action=infos"><button type="button" class="btn btn-success">Infos</button></a></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        fclose($file);
        ?>
    </table>
    <a href="traitement.php"><button type="button" class="btn btn-success">Ajouter</button></a>
</body>

</html>