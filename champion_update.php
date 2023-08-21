

<?php 

require_once('connexion.php');




if(isset($_GET['button'])){ //tableau de valeurs pour update

    $requpdate = array(
        "nom" => $_POST['name'],
        "cost" => $_POST['cost'],
        "health" => $_POST['health'],
        "mana" => $_POST['mana'],
        "armor" => $_POST['armor'],
        "mr" => $_POST['mr'],
        "dps" => $_POST['dps'],
        "damage" => $_POST['damage'],
        "attack_speed" => $_POST['attackspeed'],
        "crit_rate" => $_POST['critrate'],
        "range_champion" => $_POST['range'],
        "idchamp" => $_GET['idchamp']
    );


    $updatechamp = $bdd->prepare('UPDATE champions SET nom = :nom, cost = :cost, health = :health, mana = :mana, armor = :armor,MR = :mr , DPS = :dps, Damage = :damage, attack_speed = :attack_speed, crit_rate = :crit_rate, range_champion = :range_champion WHERE id_champ = :idchamp');
    $updatechamp->execute($requpdate);

    header("Location: home_champ.php");
}


?>

<html>
<head>
    <link href="css/compo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="body-pd" style="background:#2F3C5C">


        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:40px">
            <a style="margin-left:10px"class="navbar-brand" href="home_champ.php">TFTHELPER</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home_champ.php"> <span class="sr-only">Champions</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home_items.php">items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home_class.php">classe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="home_favorite.php">favorite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="home_compo.php">Create compo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="home_showcompo.php">Composition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="deconnexion.php">deconnexion</a>
                </li>
                </ul>
            </div>
        </nav>


    <form method="POST">
            <div class="card" style=" height:800px; margin-top: 40px;margin-left:80px;">
                <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">cost</label>
                <input type="text" name="cost" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">Health</label>
                <input type="text" name="health" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">mana</label>
                <input type="text" name="mana" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">armor</label>
                <input type="text" name="armor" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">MR</label>
                <input type="text" name="mr" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">DPS</label>
                <input type="text" name="dps" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">Damage</label>
                <input type="text" name="damage" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">Attack speed</label>
                <input type="text" name="attackspeed" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">Crit rate</label>
                <input type="text" name="critrate" class="form-control" id="formGroupExampleInput">
                <label for="formGroupExampleInput">Range champion</label>
                <input type="text" name="range" class="form-control" id="formGroupExampleInput">

                </div>

                <button  name="button" type="submit" class="btn btn-secondary btn-sm" style="width:100px; margin-top:20px;margin-left:500px">update</button>  

            </div>
        
    </form>

    
</body>

  
</html>