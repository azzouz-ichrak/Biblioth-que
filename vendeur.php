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
      <?php   if(!isset($_GET['etat']))
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
        <a   class="active"  href="histo_rv.php">Mon profil</a>
      </li>
      <?php } ?>
    </ul>

  </nav>


  <section>
  <?php
   if(isset($_GET['etat']))
   {
         session_start();
         include("connex.inc.php");
                    $mail=$_SESSION['mail'];
                   $conn = mysqli_connect($host, $login, $mdp, $base);
            ?>
        <div>
        <?php 
                    
                    $req="SELECT * from vendeur where emailv='$mail'";
                    $res=mysqli_query($conn,$req) or die ("erreureVendeur");

                     while(($row=mysqli_fetch_array($res,MYSQLI_BOTH))!= null)
                     {
                         echo"<h2>Bonjour ".$row['prenomv']." ".$row['nomv']." ! </h2>
                         <h4>Vendre vos livres rapidement ici.</h4>
                         ";
                }
              ?>
                <div class="row">
                  
                  <div class="col-md-3 vos-livres" style="border-right:2px solid rgb(22, 22, 105);" >
                  <h2>Ajouter vos livres</h2>
                  <form class="form_contact" id="form_contact" action="addbook.php" method="POST">
             
           
               <div class="form-group">
                    <input class="form-control form-control-sparac" type="text" id="titre" name="titre" placeholder="titre de livre" required>
                </div>
            
               <div class="form-group">
               <select class="form-control form-control-sparac" id="langue" name="langue"  required>
               <option value="">Langue</option>
                    <option value="francais">Français</option>
                    <option value="anglais">Anglais</option>
                    <option value="arabe">Arabe</option>
                    <option value="autres">Autres</option>
              </select>  
              </div>
                <div class="form-group">
                <input class="form-control form-control-sparac" type="number" id="nbp" name="nbp" placeholder="nombre de pages" required>
                 </div>
                <div class="form-group">
                <input class="form-control form-control-sparac" type="number" id="prix" name="prix" placeholder="prix" required>
                 </div>
                 <div class="form-group">
            <select  class="form-control form-control-sparac"   name="promo" >
                          <option value="">pourcentage de reduction</option>
                             <?php 
                                 $req4="SELECT * FROM promotion";
                                $res4=mysqli_query($conn,$req4) or die ("erreur");
                                    while($row4=mysqli_fetch_array($res4,MYSQLI_BOTH)){
                                    echo"<option value=".$row4['idpromo'].">".$row4['pourcentage']."</option>"; } ?>
                                </select>
          </div>
            <div class="form-group">
            <select class="form-control form-control-sparac"  name="auteur" >
                          <option value="">auteur</option>
                             <?php 
                                 $req2="SELECT * FROM auteur";
                                $res2=mysqli_query($conn,$req2) or die ("erreur");
                                    while($row2=mysqli_fetch_array($res2,MYSQLI_BOTH)){
                                    echo"<option value=".$row2['idauteur'].">".$row2['nomaut']."</option>"; } ?>
                                </select>
            
                              </div>
                              
            <div class="form-group">
            <select  class="form-control form-control-sparac"   name="cat" >
                          <option value="">categories</option>
                             <?php 
                            
                                 $req3="SELECT * FROM categories";
                                $res3=mysqli_query($conn,$req3) or die ("erreur");
                                    while($row3=mysqli_fetch_array($res3,MYSQLI_BOTH)){
                                    echo"<option value=".$row3['idcat'].">".$row3['nomcat']."</option>"; } ?>
                                </select>
          </div>
          <div class="form-group">
          <input  class="form-control form-control-sparac" type="file"
       id="avatar" name="image"
       accept="image/png, image/jpeg" >
       </div>
           <div class="form-group">
         <button type="submit" class="btn btn-primary form-control form-control-sparac">Ajouter</button>
                                    </div>
               
              
                                </div>
           
        </form> 
        <div class="col-md-9 vos-livres" style="border-right:2px solid rgb(22, 22, 105);" >
        <h3>vos livres</h3>
        <div id="livres">
      <?php 
      $mail=$_SESSION['mail'];
      $sql1="SELECT idv FROM vendeur WHERE emailv='$mail'";
      $res1=mysqli_query($conn,$sql1);
      $row1=mysqli_fetch_array($res1,MYSQLI_BOTH);
      $idv=$row1['idv'];
      
  $sql="SELECT * FROM livre where idv='$idv'";
  $res=mysqli_query($conn,$sql) or die("erreur");
  while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
    $idlivre= $row['idlivre'];
    echo "" ;?>
      <div id="one-book">
        <img src="<?php echo $row['image']?>" />
        <h2 class="titre">
          <?php echo $row['titre']?>
        </h2>
        <div class="details">
         
  <h2>
            <?php 
            echo "---".$idlivre."---";
            if( $row['idpromo']!='1'){
              $promo= $row['idpromo'];
              $sql5="SELECT * from promotion WHERE idpromo='$promo'";
              $res5=mysqli_query($conn,$sql5);
              $row5=mysqli_fetch_array($res5,MYSQLI_BOTH);
              $pourcentage=$row5['pourcentage'];
              $prix_initial= $row['prix'];
              $prix= ($prix_initial - (($prix_initial * $pourcentage) / 100));
              echo '<h3 class="prix-initial">'.$prix_initial.' TND</h3>';
              echo '<h2 class="prix-reduc">'.$prix.' TND</h2>'  ;

            }else {echo $row['prix'].' TND';}
             ?> 
  </h2>
          <a href="deletebook.php?idlivre=<?php echo $idlivre;?>" class="btn-panier">supprimer</a>
        </div>
      </div>

      <?php } ?>

    </div>
<div>
              </div>

              </div>
              <?php
              }
                else{
                  ?>
<div>
  <h2>Espace vendeur </h2>
    
  <div class="signin-form col-lg-6">
                <form method="post" action="cnx.php" class="form_contact">
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-sparac" placeholder="Entrer votre email" >
                    </div>
                    <div class="form-group">
                    <input type="password" name="mdp" class="form-control form-control-sparac" placeholder="Entrer votre mot de passe" required>
                    </div>
                    <div class="form-group">
                    <input type="submit" value="connecter" class="btn-primary form-control form-control-sparac">
                    </div>
                    </form>
                    <button type="" value="inscrit" class="form-control form-control-sparac"><a href="form.php">s'inscrire</a></button> 

                    </div>
              </div>
                  <?php
                } ?>

      </div>
      <div>
         

            </div>

      </section>
      </body>