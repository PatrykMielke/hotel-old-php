<?php
$to     = 'hotelvictoriaspanko@wp.pl';
$name   = $_POST['name'];
$email  =$_POST['email'];
$subject = 'Zgłoszenie od ' . $name . ' (' .$email. ')';
$message = $_POST['message'];
$headers = 'Od: ' . $name . ' (' .$email. ')';
$headers .= "Content-Type: text/html; charset=utf-8\r\n;";



mail($to, $subject, $message, $headers);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link rel="stylesheet" href="style.css">


  <title>Hotel Victoria  </title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/full-width-pics.css" rel="stylesheet">

</head>

<body>
<script>
alert("Wiadomość została wysłana")

</script>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">Hotel Victoria</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Strona Główna
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="galeria.html">Galeria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Rezerwacja</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="kontakt.html">Kontakt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="oferta.html">Oferta</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid padding">
    <div class="row padding">
      <div class="col-md-4">
        <div class="card">
          <img  class="card-img-top" src="img/team1.jpg">
          <div class="card-body">
            <h4 class="card-title">Patryk Mielke</h4>
            <p class="card-text">tworca strony</p>
            <a href="#" class="btn btn-outline-secondary">see profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header - set the background image for the header in the line below -->
<div class="container-fluid padding">
  <div class="row text-center padding">
    <div class="col-12">
      <div class="card">
      <h2 class="social">Kontakt</h2>
        <form action="mail.php" method="post" name="formularz">
          <p>Podaj imie: </p>
          <input type="text" name="name" id="name" required/><br>
          <p>Podaj email: </p>
          <input type="email" name="email" id="email" required/></br>
          <p>Wiadomość:</p>
          <textarea name="message" cols="20" rows="4" id="message" required></textarea>
            <div class="col-12">
              <input type="submit" name="submit" value="Wyślij" class="special"/>
              <input type="reset" name="reset" value="Reset"/>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Footer -->
  <div class="container-fluid padding">
    <div class="row text-center padding">
      <div class="col-12">
        <h2 class="napis">Social Media</h2>
      </div>
      <div class="col-12 social padding">
        <a href="https://pl-pl.facebook.com/DisStream/"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="m.me/2184008891652561"><i class="fab fa-facebook-messenger"></i></a>
        <a href="https://www.instagram.com/hotelvictoriainsta/"><i class="fab fa-instagram"></i></a>
        <a href=""><i class="fab fa-youtube"></i></a>

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
          <p>133-77-22-33</p>
          <p>hotelvictoriaspanko@wp.pl</p>
          <p>Zielona 123</p>
          <p>Łódź, Łódzkie, 67777</p>
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
