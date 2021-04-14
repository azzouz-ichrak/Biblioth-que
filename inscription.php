<meta charset="UTF-8">

<?php

include("connex.inc.php");
if ($conn = mysqli_connect($host, $login, $mdp, $base)){
    echo "connexion réussie <br>";
} else {die("erreur de connexion au serveur");}


        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email =htmlspecialchars($_POST['email']);
        $ville = htmlspecialchars($_POST['ville']);
        $tel = htmlspecialchars($_POST['phone']);
        $typeuser = $_POST['typeuser'];
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];


if($mdp!=$mdp2)
{
    header("location:form.php?etat=1");
}
else {
    $mails="SELECT emailv, emailch FROM vendeur, achteur where emailv='$email' or emailach='$email'";
    $res=mysqli_query($conn,$mails);
    $row=mysqli_fetch_array($res,MYSQLI_BOTH); 
    if(($_POST['email']==$row['emailv'])||($_POST['email']==$row['emailach']))
    {
        header("location:form.php?etat=1");
    } else if($_POST['typeuser']=='v')
    {
        $sql="INSERT INTO vendeur (prenomv, nomv, emailv, localisationv, numtelv , mdpv ) VALUES('".$prenom."', '".$nom."','".$email."', '".$ville."', '".$tel."', '".$mdp."')";
        $res33=mysqli_query($conn,$sql);
        session_start();
        $_SESSION['mail']=$_POST['email'];
        header("location:vendeur.php?etat=2");
       
    }else if($_POST['typeuser']=='ach')
    {
        $sql="INSERT INTO acheteur (prenomach, nomach, emailach, localisationach, numtelach , mdpach ) VALUES('".$prenom."', '".$nom."','".$email."', '".$ville."', '".$tel."', '".$mdp."')";
        $res33=mysqli_query($conn,$sql);
        session_start();
        $_SESSION['mail']=$_POST['email'];
        header("location:cnx.php");

      
    }

}



?>
