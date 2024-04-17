<?php session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
  if($_SESSION['admin']>0)
          {
            header('Location:paneladmin.php');
            exit();
          }
          else
          {
            header('Location:panel.php');
            exit();
          }
}
 ?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <style>
.error{
color:red;
margin-top: 10px;
margin-bottom: 10px;
}
</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/full-width-pics.css" rel="stylesheet">
    <title>Logowanie</title>
  </head>
  <body style="padding-top:70px;">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Strona Główna
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="galeria.php">Galeria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kontakt.php">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="oferta.php">Oferta</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="logowanie.php">Zaloguj</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container gora rezerwacja logowanie">
    <div class="row text-center" style="height:400px;">
    <form class="col-12 " action="zaloguj.php" method="post">
      login:<br/><input type="text" name="login" ><br/><br/>
      hasło:<br/><input type="password" name="haslo" ><br/><br/>
      <input type="submit" name="" value="Zaloguj"><br/>
      <?php
       if(isset($_SESSION['blad']))
       { echo $_SESSION['blad'];}
       ?>
    </form>

   </div>
    </div>


     <div class="container-fluid padding">
       <div class="row text-center padding">
         <div class="col-12">
           <h2 class="napis">Social Media</h2>
         </div>
         <div class="col-12 social padding">
           <a href="https://www.facebook.com/Hotel-Victoria-2184008891652561/"><i class="fab fa-facebook"></i></a>
           <a href="https://twitter.com/HotelVictoria12"><i class="fab fa-twitter"></i></a>
           <a href="m.me/2184008891652561"><i class="fab fa-facebook-messenger"></i></a>
           <a href="https://www.instagram.com/hotelvictoriainsta/"><i class="fab fa-instagram"></i></a>
           <a href="#"><i class="fab fa-youtube"></i></a>
         </div>
       </div>
     </div>
     <footer>
       <div class="container-fluid  padding">
         <div class="row text-center">
           <div class="col-md-4">
             <hr class="light">
             <h5>Dane Kontaktowe</h5>
             <hr class="light">
             <p>133-77-22-33</p>
             <p>Zielona 123</p>
           </div>
           <div class="col-md-4">
             <hr class="light">
             <h5>Godziny pracy</h5>
             <hr class="light">
             <p>24/7</p>
           </div>
           <div class="col-md-4">
             <hr class="light">
             <h5>Godziny pracy</h5>
             <hr class="light">
             <p>24/7</p>
           </div>
           <div class="col-12">
             <hr class="light">
             <h5>&copy; hotelwiktoria.pl Wszelkie prawa zastrzeżone</h5>
             </div>
         </div>
       </div>
     </footer>
     <!-- Bootstrap core JavaScript -->
     <script src="vendor/jquery/jquery.min.js"></script>
     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
