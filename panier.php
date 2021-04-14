<meta charset="UTF-8">

<?php

include("connex.inc.php");
$conn = mysqli_connect($host, $login, $mdp, $base); 
session_start();
$mail=$_SESSION['mail'];

if($mail=="")
{  
    echo "Vous devez connecter :";
    include("connecter.php");
}
else {
    
    $req="SELECT * FROM vendeur WHERE (emailv='$mail')";
   $req2="SELECT * FROM acheteur WHERE (emailach='$mail') ";
   
   $res=mysqli_query($conn,$req);
   $row=mysqli_fetch_array($res,MYSQLI_BOTH);
   $idlivre2 = $_GET['idk'];
 

   $res2=mysqli_query($conn,$req2);
   $row2=mysqli_fetch_array($res2,MYSQLI_BOTH);
    $idach=$row2['idach'];

   if($mail==$row['emailv']) {
      
    echo"votre compte n a pas le droit de commander des livres en tant que vendeur";
    echo "<a href='index.php'> retour à la page principale </a>";
   }
   elseif($mail==$row2['emailach']){

        $req6="SELECT * from livre where idlivre='$idlivre2' ";
        $res6=mysqli_query($conn,$req6);
        $row6=mysqli_fetch_array($res6,MYSQLI_BOTH);
        echo $idlivre2 ;
        $prixpanier=  $row6['prix'];
       
       // inserer nv livre;
       $req4="INSERT INTO panier (prixpanier, idach, idlivre) VALUES ( '$prixpanier', '$idach', '$idlivre2' )";
       $res4=mysqli_query($conn,$req4);
       header("location:profile.php?etat=55");
       echo " votre produit a été ajouté au panier ";
   }
}
?>