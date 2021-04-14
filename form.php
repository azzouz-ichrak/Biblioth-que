<!doctype html>
<html>

<head>
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
      <?php } else {echo "bienvenu !!"; ?>
      <li >
        <a   class="active"  href="decon.php">Déconnecter</a>
      </li>
      <li >
        <a   class="active"  href="histo_rv.php">Mon profil</a>
      </li>
      <?php } ?>
    </ul>

  </nav>


  <section class="sign-up" id="sign-up">
            <div class="container-fluid">
            <div class="form-group">
            
        <?php
    if(isset($_GET['etat']))
      {echo "
        <div class='form-control form-control-sparac col-xs-12 col-sm-12 col-md-12 btn-center btn-warning'>
        inscription non valide, vérifier votre mdp ou votre mail  </div>";}
            ?>
            
                                    </div>
            <div class="row">
           
                    <form class="form_contact" id="form_contact" action="inscription.php" method="POST">
               <div class="form-group">
              <input class="form-control" type="text" id="prenom" name="prenom" placeholder="Prénom *" required>
                 </div>
           
               <div class="form-group">
                    <input class="form-control form-control-sparac" type="text" id="nom" name="nom" placeholder="Nom *" required>
                </div>
            
               <div class="form-group">
               <input class="form-control form-control-sparac" type="email"  id="email" name="email" placeholder="Adresse mail *" required>
                </div>
                <div class="form-group">
                <input class="form-control form-control-sparac" type="number" id="phone" name="phone" placeholder="number" required>
                 </div>
                <div class="form-group">
                <input class="form-control form-control-sparac" type="text" id="ville" name="ville" placeholder="ville" required>
                 </div>
            <div class="form-group">
                <input class="form-control form-control-sparac" type="password" id="mdp" name="mdp" placeholder="saisir votre mot de passe" required>
                 </div>
            <div class="form-group">
                <input class="form-control form-control-sparac" type="password" id="mdp2" name="mdp2" placeholder="confirmer votre mot de passe" required>
                 </div>
           
           <div class="form-group">
          Vendeur <input type="radio" value="v" name="typeuser" >
           <br> Acheteur 
               <input type="radio" value="ach" name="typeuser">
                </div>
           
           <div class="form-group">
         <button type="submit" class="btn btn-primary form-control form-control-sparac">Envoyer</button>
                                    </div>
               
              
                                </div>
           
        </form> 
        <button type="" value="connecter" class="form-control form-control-sparac"><a href="connecter.php">Connexion</a></button> 

                </div>
                </div>
        </div>
        </section>
      </body>