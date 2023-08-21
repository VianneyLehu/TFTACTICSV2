

<?php 

require_once('connexion.php');




if(isset($_GET['button'])){

    $requpdate = array(
        "nom" => $_POST['name'],
        "description" => $_POST['description'],
        "iditems" => $_GET['id_items']
    );


    $updatechamp = $bdd->prepare('UPDATE items SET nom = :nom, description = :description WHERE id_items = :iditems');
    $updatechamp->execute($requpdate);

    header("Location: home_items.php");
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
            <div class="card" style=" height:800px; margin-top: 40px;margin-left:80px;">
                <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            
                <button  name="button" type="submit" class="btn btn-secondary btn-sm" style="width:100px; margin-top:20px;margin-left:500px">update</button>  

            </div>
        
    </form>

    
</body>

  
</html>