
<?php 

require_once('connexion.php');

$composition = $bdd->prepare('SELECT composition.id_champion as idchamp, composition.id_items as iditem,champions.image as ChampImage, items.image as ItemImage,champions.nom as ChampNom, items.nom as ItemNom FROM composition JOIN champions ON champions.id_champ = composition.id_champion JOIN items ON items.id_items = composition.id_items WHERE id_users = ?');  //recuperer les champions et items pour les afficher d'une compostion

$composition->execute([$_SESSION['id']]);

$compo_result = $composition->fetchAll();

if(isset($_POST['idfav'])){

    $insert = $bdd->prepare("INSERT INTO favorite(id_favchamp) VALUES(?)");
    $insert->execute([$_POST['idfav']]);
}

if($compo_result == NULL){
    header('Location: home_compo.php');
}


if(isset($_POST['deletebut'])){
    $delete = $bdd->prepare('DELETE FROM composition  WHERE id_users = ?');
    $delete->execute([$_SESSION['id']]);

    header("Location: home_champ.php");
}




?>



<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/champion.css">

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





    <a  class="btn" href="update_compo.php">update compo</a>  
    <form method="post">
        <button class="btn" name="deletebut" type="submit" href="">delete compo</button>  
    </form>


    

                
    <?php
    
    foreach($compo_result as $compo){
        
        ?>  
                <div id="cardcss" class="card">
                    
                    <div class="card-wrapper">

                            <form method="GET" action="update_compo.php">
                                <img class="image" src="assetprojetphp/champions/<?php echo $compo['ChampImage']?>" alt="Card image">
                                <p style="text-align:center"><?php echo $compo['ChampNom']?></p>
                                <img class="image" src="assetprojetphp/items/completeitems/<?php echo $compo['ItemImage']?>" alt="Card image">
                                <p style="text-align:center"><?php echo $compo['ItemNom']?></p>
                                <input type="hidden" name="champ" value="<?= $compo['idchamp']?> ">
                                <input type="hidden" name="item" value="<?= $compo['iditem'] ?> ">
                                <button style="margin-left:90px; background:#2F3C5C;" type="submit" class="btn btn-secondary btn-sm">update</button>  
                            </form>
                            
                    </div>

                </div>                                    
        
                        
    <?php
        
    }
    ?>

    </body>

</html>