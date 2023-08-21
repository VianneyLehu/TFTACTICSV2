<?php
    try{ //connexion a la base de donnée
      $bdd = new PDO('mysql:host=localhost;dbname=tfthelper;charset=utf8','root', '');
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
      die('Erreur: '.$e.getMessage());
  }
  session_start();

if(isset($_POST['username'])){ //inscription

  if(strcmp($_POST['password'],$_POST['confirmpassword'])== 0){
    $insert = $bdd->prepare('INSERT INTO users (username,password,email, admin) VALUES(:user,:pass,:mail, :admin)');
    $insert->execute([
            'user' => $_POST['username'],
            'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'mail' => $_POST['email'],
            'admin' => 0
    ]);
    header('Location:login.php');die;
  }
  
  else{

  }
}


if(isset($_POST['login'])){ //connexion
  $connexion = $bdd->prepare("SELECT * FROM users WHERE username = :pseudo");
  $connexion->execute(['pseudo' => $_POST['pseudo']]);
  $user_connect = $connexion->fetchAll();

  foreach ($user_connect as $user){

      if(password_verify($_POST['pass'], $user['password'])){

          if($user['admin'] == 1){
            $_SESSION['admin'] = TRUE;
          }
          else{
            $_SESSION['admin'] = FALSE;
          }

          $_SESSION['user'] = $user['username'];
          $_SESSION['mail'] = $user['email'];
          $_SESSION['id'] = $user['id'];

          header('Location: home_champ.php');die;
      }
      else{
      }
  }

}
?>













<html>
    <head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/ssweetalert2@11"></script>
    <link rel="stylesheet" href="css/login.css">

    </head>
    <body>
      <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item text-center">
                      <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item text-center">
                      <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
                    </li>
                  
                  </ul>
                  <div class="tab-content" id="pills-tabContent">

                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        
                        <div class="form px-4 pt-5">

                          <form method="post">

                            <input type="text" required="required" name="pseudo" class="form-control" placeholder="Username">

                            <input type="password" required="required" name="pass" class="form-control" placeholder="Password">


                            <button name="login" type="submit" value="Login" class="btn btn-dark btn-block">Login</button>
                          </form>
                        </div>
                      </div>



                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      
                        <div class="form px-4">

                          <form method="post">


                            <input type="text" required="required" name="username" class="form-control" placeholder="Username">

                            <input type="text" required="required" name="email" class="form-control" placeholder="Email">

                            <input type="password" required="required" name="password" class="form-control" placeholder="Password">

                            <input type="password" required="required" name="confirmpassword" class="form-control" placeholder="Confirm Password">

                            <button type="submit" required="required" value="Signup" class="btn btn-dark btn-block">Signup</button>

                            
                          </form>

                          

                        </div>

                    </post> 


                    </div>
                    
                  </div>
                
              
              

            </div>


      </div>

                 
    </body>


</html>