
<?php 

require_once('connexion.php');


$champitem = $bdd->prepare('SELECT champions.id_champ as idChamp,items.id_items as idItem,champions.nom as ChampNom , items.nom as ItemNom From champions JOIN items on champions.id_champ = items.id_items');

$champitem->execute();

$champitem_result = $champitem->fetchAll();







$composition = $bdd->prepare('SELECT items.id_items as idItem, champions.id_champ as idChamp, champions.nom as ChampNom, items.nom as ItemNom FROM composition JOIN champions ON champions.id_champ = composition.id_champion JOIN items ON items.id_items = composition.id_items WHERE id_users = ?');

$composition->execute([$_SESSION['id']]);

$compo_result = $composition->fetchAll();





if(isset($_POST['btn_activate'])){



    $requpdate = array(
        "champ" => $_POST['champ_update'],
        "item" => $_POST['item_update'],
        "user" => $_SESSION['id'],
        "champ2" => $_GET['champ'],
        "item2" => $_GET['item']
    );

    $insert = $bdd->prepare('UPDATE composition SET id_champion = :champ , id_items = :item WHERE id_users = :user AND id_champion = :champ2 AND id_items = :item2 ');   
    //$insert->execute([$_SESSION['id'] , $_GET['champ'], $_GET['item'], $_POST['champ_update'] , $_POST['item_update']]);
        
    $insert->execute($requpdate);



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
                <li class="n<av-item">
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
                </ul>
            </div>
        </nav>

    <form method="post">
            <div class="card" style="margin-top: 40px;margin-left:80px;">
                <div class="form-group">
                    <div class="champ">
                        <label for="exampleFormControlSelect1">champions:</label>
                        <select name="champ_update" class="form-control" id="exampleFormControlSelect1">
                        <?php foreach($champitem_result as $ci) { ?>
                            <option  value="<?php echo $ci['idChamp'] ?>" ><?php echo $ci['ChampNom']; ?></option>
                        <?php } ?>     
                        </select>
                        <div class="items">
                            <label for="exampleFormControlSelect1">items:</label>
                            <select name="item_update" class="form-control" id="exampleFormControlSelect1"><?php foreach($champitem_result as $ci) { ?>
                                <option value="<?php echo $ci['idItem'] ?>"><?php echo $ci['ItemNom']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <button  name="btn_activate" type="submit" class="btn btn-secondary btn-sm" style="width:100px; margin-top:20px;margin-left:500px">update comp</button>  

            </div>
        
    </form>

    
</body>

  
</html>