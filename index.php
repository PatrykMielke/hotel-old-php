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
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link rel="stylesheet" href="style.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/full-width-pics.css" rel="stylesheet">
  <title>Hotel Victoria </title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
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
          <li class="nav-item">
            <a class="nav-link" href="logowanie.php">Zaloguj</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="py-5 bg-image-full gora" style="background-image: url('hotel.png'), url('hotel1.png')">
    <img class="img-fluid d-block mx-auto" src="img/logod.png" >
  </header>
  <section class="py-5">
    <div class="container">
      <h1>Niesamowite oferty</h1>
      <p class="lead">Skorzystaj już teraz.</p>
      <p>Sprawdź nasze oferty gwarantujemy, że znajdziesz coś dla Siebie.</p>
    </div>
  </section>
  <section class="py-5 bg-image-full" style="background-image: url('hotel1.png');">
    <div style="height: 200px;"></div>
  </section>
  <section class="py-5">
    <div class="container">
      <h1>Piękny Hotel </h1>
      <p class="lead">Zarezerwuj pokój marzeń już teraz.</p>
      <p>Odpoczynek dla ciała i ducha oraz mnóstwo atrakcji, które będziesz pamiętał do końca życia.</p>
    </div>
  </section>
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
    <div class="container-fluid padding">
      <div class="row text-center">
        <div class="col-md-4">
          <hr class="light">
          <h5>Dane Kontaktowe</h5>
          <hr class="light">
          <p>hotelvictoriaspanko@gmail.com</p>
        </div>
        <div class="col-md-4">
          <hr class="light">
          <h5>Godziny pracy</h5>
          <hr class="light">
          <p>24/7</p>
        </div>
        <div class="col-md-4">
          <hr class="light">
          <h5>Adres</h5>
          <hr class="light">
          <p>Za górami za lasami</p>
        </div>
        <div class="col-12">
          <hr class="light">
          <h5> hotelvictoria.com &copy; Wszelkie prawa zastrzeżone</h5>
          </div>
      </div>
    </div>
  </footer>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
