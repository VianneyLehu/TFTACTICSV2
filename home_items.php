
<?php 
    require_once('connexion.php');

    $item = $bdd->prepare('SELECT id_items,nom,description,image FROM items'); //on recupere les items pour les afficher

    $item->execute();

    $item_result = $item->fetchAll();



?>




<html>
    <head>
        <link rel="stylesheet" href="css/items.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
      


    </head>

    <body id="body-pd" style="background:#2F3C5C;color:white">

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

            <table class="table table-dark table-striped">

            
            
                    <?php 
                        foreach($item_result as $items){
                            ?>
                            <div class="card" style="background:#17141D; margin-left:60px">
                                <img class="image" src="assetprojetphp/items/completeitems/<?php echo $items['image']?>" alt="Card image">
                                <div class="card-body">
                                    <h4 name="nom2" class="card-title"><?php echo $items['nom'] ?></h4>
                                    <p class="card-text"><?php echo $items['description'] ?></p>
                                </div>

                                <?php if($_SESSION['admin'] == TRUE){ ?>
                                        <form method="GET" action="item_update.php">
                                            <button  name="itembutton" style="margin-left:50px; background:#2F3C5C;" type="submit" class="btn btn-secondary btn-sm">update</button>
                                            <input type="hidden" name="updatechamp" value="<?= $items['id_items']?>">
                                        </form>
                            <?php } ?>
                            </div>
                            <?php
                            
                        }
                        ?>
                </tbody>

            </table>

             

    </body>

</html>