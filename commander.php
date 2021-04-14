<meta charset="UTF-8">

<?php

include("connex.inc.php");
$conn = mysqli_connect($host, $login, $mdp, $base); 
session_start();
$mail=$_SESSION['mail'];

$datedebut = htmlspecialchars($_POST['datedebut']);
$datefin = htmlspecialchars($_POST['datefin']);
if($datedebut==''){
    $datedebut= date('d-m-y');
}
if($datefin==''){
    $datefin = date('d-m-y');
}
$idtype = $_POST['typecmd'];
$idpaiement = $_POST['paiement'];



$sql1="SELECT idach FROM acheteur WHERE emailach='$mail'";
$res1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($res1,MYSQLI_BOTH);
$idach=$row1['idach'];

$sql="SELECT * FROM panier WHERE idach='$idach'";
$res=mysqli_query($conn,$sql);

  
  while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
    $panier = $row['idpanier'] ;
    $com="INSERT INTO commande (idtype, idpanier, idpaiement, datedebut, datefin) VALUES ('".$idtype."', '".$panier."', '".$idpaiement."', '".$datedebut."', '".$datefin."')";
    $rescom=mysqli_query($conn,$com);
    if($rescom=true)
   // echo $idtype."', '".$panier."', '".$idpaiement."', '".$datedebut."', '".$datefin.'<br>' ;

    {header("location:profile.php?etat=2");}
  }

?>