<?php


    //connexion a la base de donnée

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=tfthelper;charset=utf8','root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        die('Erreur: '.$e.getMessage());
    }
    session_start();




    if (!isset($_SESSION['id'])) //check si l'utilisateur est connecté
    {
        header('Location: login.php');die;
    }




    
 