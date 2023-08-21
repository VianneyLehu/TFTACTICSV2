

<?php 

require_once('connexion.php');

$champion = $bdd->prepare('SELECT DISTINCT id_champ,nom,Description,cost,health,mana,armor,MR,DPS,Damage,attack_speed,crit_rate, range_champion,image FROM champions  INNER JOIN favorite ON champions.id_champ = favorite.id_favchamp'); //recuperer les champions pour afficher les champions favoris

$champion->execute();

$champion_result = $champion->fetchAll();


if(isset($_POST['idfav'])){

    $insert = $bdd->prepare("INSERT INTO favorite(id_favchamp) VALUES(?)");
    $insert->execute([$_POST['idfav']]);
}




?>


<html>
    <head>
        <link rel="stylesheet" href="css/champion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">


        <script type="text/javascript" src="home.js"></script>



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


        <?php 

foreach($champion_result as $hero){
    
    ?>  
            <div id="cardcss" class="card">
                
                <div class="card-wrapper">
                        <img class="image" src="assetprojetphp/champions/<?php echo $hero['image']?>" alt="Card image">

                        <form method="post" action="">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $hero['nom'] ?></h4>
                                <input type="hidden" name="idfav" value="<?php echo $hero['id_champ'] ?>">
                                <p class="card-text">cout: <?php echo $hero['cost'] ?></p>
                                <p class="card-text">heath: <?php echo $hero['health'] ?></p>
                                <p class="card-text">mana: <?php echo $hero['mana'] ?></p>
                                <p class="card-text">armor: <?php echo $hero['armor'] ?></p>
                                <p class="card-text">MR: <?php echo $hero['MR'] ?></p>
                                <p class="card-text">DPS: <?php echo $hero['DPS'] ?></p>
                                <p class="card-text">Damage: <?php echo $hero['Damage'] ?></p>
                                <p class="card-text">Attack speed: <?php echo $hero['attack_speed'] ?></p>
                                <p class="card-text">Crit rate: <?php echo $hero['crit_rate'] ?></p>
                                <p class="card-text">Range champion: <?php echo $hero['range_champion'] ?></p>
                                </div>
                        </form>
                        
                </div>

            </div>                                    
            
                            
        <?php
            
        }
        ?>

    </body>

</html>