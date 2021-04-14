<meta charset="UTF-8">

<?php

include("connex.inc.php");
if ($conn = mysqli_connect($host, $login, $mdp, $base)){
    echo "connexion réussie <br>";
} else {die("erreur de connexion au serveur");}

$email =$_POST['email'];
$mdp = $_POST['mdp'];

 $req="SELECT * FROM vendeur WHERE 

 (emailv='$email' AND mdpv='$mdp' )
 "
 
;
$req2="SELECT * FROM acheteur WHERE 

(emailach='$email' AND mdpach='$mdp' ) "

;

$res=mysqli_query($conn,$req);
$row=mysqli_fetch_array($res,MYSQLI_BOTH);

$res2=mysqli_query($conn,$req2);
$row2=mysqli_fetch_array($res2,MYSQLI_BOTH);
        if(($_POST['email']==$row['emailv']) && ($_POST['mdp']==$row['mdpv'])){

                            session_start();
                            $_SESSION['mail']=$_POST['email'];
                            header("location:vendeur.php?etat=1");
                            }//endIf 
       elseif(($_POST['email']==$row2['emailach']) && ($_POST['mdp']==$row2['mdpach'])){

                                session_start();
                                $_SESSION['mail']=$_POST['email'];
                                header("location:index.php?etat=1");
                                }
                                else
                                {header("location:connecter.php?etat=1");}
                            
                               
 
  

      
 ?>