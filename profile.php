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
      <li> <a href="index.php">
          Home
        </a>
      </li>
      <?php   
        include("connex.inc.php");
       $conn = mysqli_connect($host, $login, $mdp, $base);
      session_start();
      
      if(!isset($_SESSION['mail']))
    { ?>
      <li>
        <a class="active" href="form.php">Inscrire</a>
      </li>
      <li>
        <a class="active" href="connecter.php">Connecter</a>
      </li>
      <?php } else { ?>
      <li>
        <a class="active" href="decon.php">Déconnecter</a>
      </li>
      <li>
        <a class="active" <?php $mail=$_SESSION['mail']; 
        $req11="SELECT emailv from vendeur where emailv='$mail'" ;
          $res11=mysqli_query($conn,$req11) or die ("erreureVendeur");
          if((($row11=mysqli_fetch_array($res11,MYSQLI_BOTH))!=null)) {echo 'href="vendeur.php?etat=1"' ;} else{
          echo 'href="profile.php"' ;} ?> >Mon profil</a>
      </li>
      <?php } ?>
    </ul>

  </nav>
  <section>
    <div class="row">
      <div class="col-md-6">
        <h2>Mon panier </h2>
        <?php 
         
  $req2="SELECT * FROM acheteur WHERE (emailach='$mail') ";
  $res2=mysqli_query($conn,$req2);
  $row2=mysqli_fetch_array($res2,MYSQLI_BOTH);
  $idach=$row2['idach'];


  $sql="SELECT * FROM panier WHERE (idach='$idach') AND 
  (idpanier NOT IN (SELECT idpanier from commande )
  )";
  $res=mysqli_query($conn,$sql) or die("err33eur");
  while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
     $livre = $row['idlivre'];
     $panier = $row['idpanier'];
     $req88 = "SELECT * from livre WHERE idlivre='$livre'";
     $res88 = mysqli_query($conn,$req88) or die("erreur");
     $row88=mysqli_fetch_array($res88,MYSQLI_BOTH);
    ?>
        <div id="panier-one-book" style="width: 100% !important;">
          <img src="<?php echo $row88['image']?>" />
          <h3 class="titre">
            <?php echo $row88['titre'];
            ?>
          </h3>
          <div class="details">
            <?php 
            if( $row88['idpromo']!='1'){
              $promo= $row88['idpromo'];
              $sql5="SELECT * from promotion WHERE idpromo='$promo'";
              $res5=mysqli_query($conn,$sql5);
              $row5=mysqli_fetch_array($res5,MYSQLI_BOTH);
              $pourcentage=$row5['pourcentage'];
              $prix_initial= $row88['prix'];
              $prix= ($prix_initial - (($prix_initial * $pourcentage) / 100));
              echo '<h4 class="prix-initial">'.$prix_initial.' TND</h4>';
              echo '<h3 class="prix-reduc" style="color: red;">'.$prix.' TND</h3>'  ;
            }else {echo '<h3>'.$row88['prix'].' TND</h3>';}
             ?>
            <a href="delete.php?idpanier=<?php echo $panier; ?>" class="btn-panier">Supprimer</a>
          </div>
        </div>

        <?php } ?>

        <div id="somme">
          <h3 style="color:red;">la somme du panier est :
            <?php 
            $sql22="SELECT SUM(prixpanier), idpanier FROM panier WHERE idach='$idach' 
            AND (idpanier NOT IN (SELECT idpanier from commande ))
            ";
            $res22=mysqli_query($conn,$sql22) or die("erreur");
            while($row22=mysqli_fetch_array($res22,MYSQLI_BOTH)){
              echo $row22['0'].' TND';}
            ?>
          </h3>
        </div>
        <div>
          <form method="post" action="commander.php" class="form_comm">
            <h4>choisissez le type de commande</h4>
            <div class="form-group">
              <select class="form-control form-control-sparac" name="typecmd">
                <option value="">type de commande</option>
                <?php 
                                 $req222="SELECT * FROM typecmd";
                                $res222=mysqli_query($conn,$req222) or die ("erreur");
                                    while($row222=mysqli_fetch_array($res222,MYSQLI_BOTH)){
                                    echo"<option value=".$row222['idtype'].">".$row222['typecmd']."</option>"; } ?>


              </select>

            </div>

            <h4> Si le type de commande est location, s'il vous plais inserer la date de début de location et la date de
              fin</h4>
            <div class="form-group">
              <?php echo date('d/m/Y');  ?>
              <input class="form-control form-control-sparac" value='date' type="date" id="datedebut"
                name="datedebut" />
              <input class="form-control form-control-sparac" value=date type="date" id="datefin" name="datefin" />
            </div>
            <h4>choisissez le type de paiement</h4>
            <div class="form-group">
              <select class="form-control form-control-sparac" name="paiement">
                <option value="">type de paiement</option>
                <?php 
                                 $req9="SELECT * FROM paiement";
                                $res9=mysqli_query($conn,$req9) or die ("erreur");
                                    while($row9=mysqli_fetch_array($res9,MYSQLI_BOTH)){
                                    echo"<option value=".$row9['idpaiement'].">".$row9['modepaiement']."</option>"; } ?>


              </select>

            </div>
            <h3><button type="submit" class="btn-primary btn" class="form-control form-control-sparac">
                Commander </button></h3>
        </div>

      </div>
      <div class="col-md-6" style="border-left:2px solid blue; padding-left:10px;">
        <h2>Mes commandes </h2>
       
        <?php 
  $sql="SELECT * FROM panier WHERE (idach='$idach') AND 
  (idpanier IN (SELECT idpanier from commande )
  )";
  $res=mysqli_query($conn,$sql) or die("err33eur");
  while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
     $livre = $row['idlivre'];
     $panier = $row['idpanier'];
     $req88 = "SELECT * from livre WHERE idlivre='$livre'";
     $res88 = mysqli_query($conn,$req88) or die("erreur");
     $row88=mysqli_fetch_array($res88,MYSQLI_BOTH);

     $req10 = "SELECT * from commande WHERE idpanier='$panier'";
     $res10 = mysqli_query($conn,$req10) or die("erreur");
     $row10=mysqli_fetch_array($res10,MYSQLI_BOTH);

    ?>
        <div id="panier-one-book" style="width: 100% !important;">
          <img src="<?php echo $row88['image']?>" />
          <h3 class="titre">
            <?php echo $row88['titre'];
            ?>
          </h3>
          <div class="details">
          <h3>  <?php echo $row['prixpanier'];  ?> TND</h3>
          <?php
            $type= '';
          ?>
          <h4><?php 
          $sq="SELECT * from commande where idpanier='$panier'";
          $rs=mysqli_query($conn,$sq);
          $r=mysqli_fetch_array($rs,MYSQLI_BOTH);
          $idtype= $r['idtype'];
          $type="SELECT * from typecmd where idtype='$idtype'";
          $restype=mysqli_query($conn,$type);
          $rowtype=mysqli_fetch_array($restype,MYSQLI_BOTH);
          echo $rowtype['typecmd'];
          ?> </h4>
            <h5 style="margin-left:10px;"> date de debut :  <?php echo $row10['datedebut'];  ?> <br>
           date de fin : <?php echo $row10['datefin'];  ?></h5>
           
          </div>
        </div>

        <?php } ?>
      </div>
    </div>
  </section>
</body>