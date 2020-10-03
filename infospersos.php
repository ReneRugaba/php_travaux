<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <title>INFORMATIONS PERSOS</title>
</head>

<body>
    <table>
        <?php
        if (!empty($_GET) && $_GET['action'] == 'infos') {
            $file = fopen('data.txt', 'r');
            while (!feof($file)) {
                $line = fgets($file);
                $mot = explode(';', $line);
                if ($_GET['id'] == $mot[0]) {

        ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h1 class="blockquote text-center">NOM: <?php echo  $mot[1]; ?></h1>
                                </div>
                                <div>
                                    <h3 class="blockquote text-center ">PRENOM: <?php echo  $mot[2]; ?></h3>
                                </div>
                                <div>
                                    <h3 class="blockquote text-center">DATE DE NAISSANCE: <?php echo  $mot[3]; ?></h3>
                                </div>
                                <div>
                                    <h3 class="blockquote text-center ">EMAIL: <?php echo  $mot[0]; ?></h3>
                                </div>
                                <a href="index.php?id=<?php echo $_GET['id']; ?>&action=edit" class="d-flex justify-content-center"><button type="button" class="btn btn-info">Modifier</button></a>
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
            fclose($file);
        }
        ?>

    </table>

</body>

</html>