
<meta charset="UTF-8">

<?php

include("connex.inc.php");
$conn = mysqli_connect($host, $login, $mdp, $base); 
session_start();
$mail=$_SESSION['mail'];
$idlivre = $_GET['idlivre'];
echo $_GET['idlivre'];

$req2="SELECT * FROM vendeur WHERE (emailv='$mail') ";
$res2=mysqli_query($conn,$req2);
$row2=mysqli_fetch_array($res2,MYSQLI_BOTH);
$idv=$row2['idv'];



$req="SELECT * from panier where idlivre='$idlivre'";
$res=mysqli_query($conn,$req);
$row=mysqli_fetch_array($res,MYSQLI_BOTH);
if($row!=''){
    $idpanier= $row['idpanier'];
    $req44="SELECT * from commande where idpanier='$idpanier'";
    $res44=mysqli_query($conn,$req44);
    $row44=mysqli_fetch_array($res44,MYSQLI_BOTH);
    if($row44!=''){
        echo "vous ne pouvez pas le supprimer car le produit est déjà commandé";
       echo "<a href='vendeur.php?etat=8' > retour à votre espace ici. </a>";
        }else{
        $req6="DELETE FROM livre where (idlivre='$idlivre') AND (idv='$idv') ";
        $res6=mysqli_query($conn,$req6);
        if($res6=true)
        {echo "<a href='vendeur.php?etat=8'> retour à votre espace ici. </a>";
            echo " votre produit a été supprimer ";}
    }
}

if($row==''){
        $req6="DELETE FROM livre where (idlivre='$idlivre') AND (idv='$idv') ";
        $res6=mysqli_query($conn,$req6);
        if($res6=true)
                {echo "<a href='vendeur.php?etat=8'> retour à votre espace ici. </a>";
                echo " votre produit a été supprimer ";}
}
?>
