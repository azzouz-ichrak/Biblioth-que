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
   <li> <a href="#page-top">
      Home
    </a>
</li>
      <li >
        <a   class="active"  href="form.php">Inscrire</a>
      </li>
      <li >
        <a   class="active"  href="connecter.php">Connecter</a>
      </li>

    </ul>

  </nav>





        <section class="sign-in" id="sign-in">
            <div class="container-fluid">
            <div class="row">
            <?php
              if(isset($_GET['etat'])){
	          echo"login and mdp are incorrect";
              } ?>
                
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
            </div>
        </section>
       
    </body>
    
    </html>