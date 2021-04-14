<meta charset="UTF-8">

<?php

include("connex.inc.php");
$conn = mysqli_connect($host, $login, $mdp, $base); 
session_start();
$mail=$_SESSION['mail'];
$idpanier = $_GET['idpanier'];
//echo $_GET['idpanier'];

$req2="SELECT * FROM acheteur WHERE (emailach='$mail') ";
$res2=mysqli_query($conn,$req2);
$row2=mysqli_fetch_array($res2,MYSQLI_BOTH);
$idach=$row2['idach'];


$req6="DELETE FROM panier where (idpanier='$idpanier') AND (idach='$idach') ";
$res6=mysqli_query($conn,$req6);
//$row6=mysqli_fetch_array($res6,MYSQLI_BOTH);
//header("location:profile.php?etat=6");
if($res6=true)
{header("location:profile.php?etat=6");
echo " votre produit a été supprimer ";}

?>
