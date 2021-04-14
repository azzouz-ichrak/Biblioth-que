<!doctype html>
<html>

<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bibliothéque</title>

  <!-- Css Styles -->
  <link rel="stylesheet" href="style.css" type="text/css">
 
</head>
<body>
  <!-- Navigation -->
  <nav>
  <ul>
   <li> <a href="#page-top">
      Home
    </a>
</li>
      <?php   
        include("connex.inc.php");
       $conn = mysqli_connect($host, $login, $mdp, $base);
      session_start();
      
      if(!isset($_SESSION['mail']))
    { ?>
      <li >
        <a   class="active"  href="form.php">Inscrire</a>
      </li>
      <li >
        <a   class="active"  href="connecter.php">Connecter</a>
      </li>
      <?php } else { ?>
      <li >
        <a   class="active"  href="decon.php">Déconnecter</a>
      </li>
      <li >
        <a   class="active" <?php 
        $mail = $_SESSION['mail'];
        $req11="SELECT emailv from vendeur where emailv='$mail'";
        $res11=mysqli_query($conn,$req11) or die ("erreureVendeur");
        
        if((($row11=mysqli_fetch_array($res11,MYSQLI_BOTH))!= null)) 
        {echo 'href="vendeur.php?etat=1"' ;}
        else{ echo 'href="profile.php?etat=1"' ;}
        ?> >Mon profil</a>
      </li>
      <?php } ?>
    </ul>

  </nav>

  <section>
    
    <div id="livres">
      <?php 
  include("connex.inc.php");
  $conn = mysqli_connect($host, $login, $mdp, $base);

  $sql="SELECT * FROM livre";
  $res=mysqli_query($conn,$sql) or die("erreur");
  while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
    
    ?>
      <div id="one-book">
        <img src="<?php echo $row['image']?>" />
        <h2 class="titre">
          <?php echo $row['titre'] ;
           $idlivre = $row['idlivre'];
           echo $idlivre ;
          ?>
        </h2>
        <div class="details">
          <h2>
          <h2>
            <?php 
            if( $row['idpromo']!='1'){
              $promo= $row['idpromo'];
              $sql5="SELECT * from promotion WHERE idpromo='$promo'";
              $res5=mysqli_query($conn,$sql5);
              $row5=mysqli_fetch_array($res5,MYSQLI_BOTH);
              $pourcentage=$row5['pourcentage'];
              $prix_initial= $row['prix'];
              $prix= ($prix_initial - (($prix_initial * $pourcentage) / 100));
              echo '<h3 class="prix-initial">'.$prix_initial.' TND</h3>';
              echo '<h2 class="prix-reduc" style="color: red;">'.$prix.' TND</h2>'  ;
            }else {echo $row['prix'].' TND';}
             ?> 
  </h2>
  </h2>
          <a href="panier.php?idk=<?php echo $idlivre; ?>" class="btn-panier">Ajouter au panier</a>
        </div>
      </div>

      <?php } ?>

    </div>
  </section>


</body>