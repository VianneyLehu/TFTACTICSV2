

<?php 

require_once('connexion.php');

$champitem = $bdd->prepare('SELECT champions.id_champ as idChamp,items.id_items as idItem,champions.nom as ChampNom , items.nom as ItemNom From champions JOIN items on champions.id_champ = items.id_items'); //requete des champions et des items pour inserer dans une compostion

$champitem->execute();

$champitem_result = $champitem->fetchAll();


//insert in composition 

$checkcompo = $bdd->prepare('SELECT * FROM composition WHERE id_users = ?');
$checkcompo->execute([$_SESSION['id']]);
$checkcompores = $checkcompo->fetch();



if($checkcompores != NULL){
    echo "<script>alert('vous avez deja une composition');</script>";
    header("Location: home_showcompo.php");
}




if(isset($_POST['btn_activate']) && $checkcompores == NULL){

    $champtab = array();

    
    for($i=1; $i<= 3; $i++){ //stock les données dans un tableau pour verifier les doublons
        array_push($champtab, $_POST['champ'.$i]);
    }

    if(count($champtab) == count(array_unique($champtab))){

        for($i=1; $i<= 3; $i++){

            $insert = $bdd->prepare('INSERT INTO composition(id_champion, id_items, id_users) VALUES(?,?,?)');
            $insert->execute([$_POST['champ'.$i], $_POST['item'.$i],$_SESSION['id']]);
        }
        header("Location: home_showcompo.php");
    }
    else{
        echo "<script>alert('vous ne pouvez pas mettre de champion en double');</script>";
    }
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


    <form method="post">
            <div class="card" style="margin-top: 40px;margin-left:80px;">
                <div class="form-group">
                <?php for($i=1;$i<=3;$i++){ ?>

                    <div class="champ">
                        <label for="exampleFormControlSelect1">champions <?php echo($i) ?>:</label>
                        <select name="champ<?php echo $i ?>" class="form-control" id="exampleFormControlSelect1">
                        <?php foreach($champitem_result as $ci) { ?>
                            <option  value="<?php echo $ci['idChamp'] ?>" ><?php echo $ci['ChampNom']; ?></option>
                        <?php } ?>

                          
                        </select>
                        <div class="items">
                            <label for="exampleFormControlSelect1">items <?php echo($i)?>:</label>
                            <select name="item<?php echo $i ?>" class="form-control" id="exampleFormControlSelect1">
                            <?php foreach($champitem_result as $ci) { ?>
                                <option value="<?php echo $ci['idItem'] ?>"><?php echo $ci['ItemNom']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                
                <?php } ?>
                </div>

                <button  name="btn_activate" type="submit" class="btn btn-secondary btn-sm" style="width:100px; margin-top:20px;margin-left:500px">create comp</button>  

            </div>
        
    </form>

    
</body>

  
</html>