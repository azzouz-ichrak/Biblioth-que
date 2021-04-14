<meta charset="UTF-8">

<?php

include("connex.inc.php");
if ($conn = mysqli_connect($host, $login, $mdp, $base)){
    echo "connexion réussie <br>";
} else {die("erreur de connexion au serveur");}

session_start();

$mail=$_SESSION['mail'];
$sql1="SELECT idv FROM vendeur WHERE emailv='$mail'";
$res1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($res1,MYSQLI_BOTH);
$idv=$row1['idv'];



$titre = htmlspecialchars($_POST['titre']);
$langue = htmlspecialchars($_POST['langue']);
$nbp = htmlspecialchars($_POST['nbp']);
$prix = htmlspecialchars($_POST['prix']);
$promo = htmlspecialchars($_POST['promo']);
$idauteur = htmlspecialchars($_POST['auteur']);
$idcat = htmlspecialchars($_POST['cat']);
$image = 'img/'.htmlspecialchars($_POST['image']);

$sql="INSERT INTO livre (titre, langue, nbp, prix, idpromo, idauteur , idcat, image, idv ) VALUES ('".$titre."', '".$langue."', '".$nbp."', '".$prix."', '".$promo."', '".$idauteur."', '".$idcat."', '".$image."', '".$idv."')";

$res=mysqli_query($conn,$sql);
if($res)
{
    echo"votre livre a été bien ajouté <br>";
    header("location:vendeur.php?etat=1");
} else {echo"ereur ajout livre <br> '$sql'";}

?>