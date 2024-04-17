<!DOCTYPE html>
<html lang="pl" dir="ltr">
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
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Strona Główna
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

    <div class="rezerwacja">

   <form class="rezerwacja" action="#" method="POST">
 <div class="col-md-4">
     Imię:</br>
   <input name="imie" type="text" required>
   </div>
     <div class="col-md-4">
     Nazwisko: </br>
   <input name="nazwisko" type="text" required>
   </div>
     <div class="col-md-4">
     Numer telefonu:</br>
   <input name="numer" type="text" required>
   </div>
     <div class="col-md-4">
     Email: </br>
   <input name="email" type="text" required><br/><br/>
   </div>
   <div class="col-md-4">

     Wybierz Pokój:</br>
   <select name="wybranyPokoj">
    <option value="Pokoj Krolewski">Pokoj Krolewski</option>
    <option value="Pokoj Szlachecki">Pokoj Szlachecki</option>
    <option value="Pokoj Wielki">Pokoj Wielki</option>
    <option value="Pokoj Duzy">Pokoj Duzy</option>
  </select>

</div>
<div class="col-md-4">
</br>
  Data przyjazdu:</br>
  <input type="date" name="dataod"  required>
</div>
<div class="col-md-4">
</br>
  Data wyjazdu:</br>
  <input type="date" name="datado"  required></br>

  <input type="submit" name="submit" value="Zarezerwuj">
  </div>
</form>

    <?php

    if(isset($_POST["submit"]))
    {
    if(isset($_POST["imie"]))
    {
      require_once 'connect.php';
      $conn = new mysqli($host,$db_user,$db_password,$db_name);
      $imie = $_POST["imie"];
      $nazwisko = $_POST["nazwisko"];
      $numer = $_POST["numer"];
      $email = $_POST["email"];
      $wybranyPokoj = $_POST["wybranyPokoj"];
      $dataod = $_POST["dataod"];
      $datado = $_POST["datado"];
      $data=date("Y-m-d");
      $datapoprawna=true;
      if(($dataod<$data)||($datado<$data)||($dataod>$datado))
      {
        $datapoprawna=false;
      }

      if(empty ($imie) || empty($nazwisko) || empty($numer) || empty($email) || $datapoprawna==false)
      {
        echo "Wypełnij wszystkie pola lub sprawdz czy wprowadziłeś poprawną datę";
      }
      else
      {
      $wyciaganieemailzbazy =("SELECT * from klienci WHERE email='$email' and imie='$imie' and nazwisko='$nazwisko' and numer='$numer'");
      $emailzbazy = mysqli_query($conn,$wyciaganieemailzbazy);
      if(mysqli_num_rows($emailzbazy)>0)
      {
      }
      else {
        $klient = $conn->query("INSERT INTO klienci(imie,nazwisko,numer,email) VALUES ('$imie','$nazwisko','$numer','$email')");
      }

      $zapytanieDoKlienta = $conn->query("SELECT * FROM klienci Where imie='$imie' and nazwisko='$nazwisko' and numer='$numer' and email='$email'");


      $wierszDoKlienta = $zapytanieDoKlienta->fetch_assoc();

      $idKlienta = $wierszDoKlienta['id_klienta'];

      echo $idKlienta;
      $zapytanieDoKlienta->close();

      if ($wierszDoKlienta)
      {
      $zapytanieDoPokoju = $conn->query("SELECT * FROM pokoje Where nazwa_pokoju='$wybranyPokoj'");

      $wierszDoPokoju = $zapytanieDoPokoju->fetch_assoc();

      $idPokoju = $wierszDoPokoju['id_pokoju'];
      $cena=$wierszDoPokoju['cena'];
      echo $idPokoju;
      $earlier=new DateTime("$dataod");
      $later=new DateTime("$datado");
      $diff=$later->diff($earlier)->format("%a");
      $cenarazem=$diff*$cena;

      $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$idPokoju' and (od <= '$datado') and ('$dataod' <= do) ");
      $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
      $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$idPokoju' and (od <= '$datado') and ('$dataod' <= do) ");
      $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);

      if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
      {
        echo "<script>
    alert('Nie udało się zrobić rezerwacji ta data jest zajęta');
    window.location.href='index.php';
    </script>";
      }
      else {
          $odp = $conn->query("INSERT INTO rezerwacje (id_klienta,id_pokoju,od,do,ilosc_dni,cenarazem) VALUES ('$idKlienta','$idPokoju','$dataod','$datado','$diff','$cenarazem')");
          if($odp)
          {
    		 echo  "<script>
    alert('Udalo sie');
    window.location.href='index.php';
    </script>";
$conn->close();

          }
          else
          {
            echo "<script>
       alert('Nie udało się dodać rezerwacji');
       window.location.href='index.php';
       </script>";
             $conn->close();
          }
      }



      }

      $conn->close();

    }
    }
  }
     ?>
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
             <p>133-77-22-33</p>
             <p>hotelwiktoria@spanko.com</p>
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
