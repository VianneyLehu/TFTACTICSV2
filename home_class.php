

<?php 

    require_once('connexion.php');

    $class = $bdd->prepare('SELECT nom,Description,Statistiques,nombre_champion FROM classe'); //on recupere les classes pour les afficher

    $class->execute();

    $class_result = $class->fetchAll();

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
            
            <table class="table table-bordered table-dark" style="background:#1A2234">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Statistiques</th>
                            <th>nombre_champion</th>      
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($class_result as $classe){
                                ?>
                                <tr>
                                <td> <?php echo $classe['nom'] ?> </td>      
                                <td> <?php echo nl2br($classe['Description'])?>              
                                <td><?php echo nl2br($classe['Statistiques']) ?> </td>                
                                <td> <?php echo $classe['nombre_champion'] ?> </td>  
                                </tr>                
                                <?php
                                
                            }
                            ?>
                    </tbody>

                </table>


    </body>

      
</html>