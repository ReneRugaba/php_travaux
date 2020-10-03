<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <form action="index.php?action=add" method="POST">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="text" name="nom" id="nom" class="form-control" placeholder="votre nom"><br>
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="prenom"><br>
            </div>
            <div class="form-group col-md-2">
                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="votre email"><br>
            </div>
            <div class="form-group col-md-2">
                <input type="date" name="dateN" id="dateN" class="form-control"><br>
            </div>
            <input type="submit" class="btn btn-primary" value="soumettre">
        </div>
    </form>
</body>

</html>