<?php session_start();
require_once 'connect.php';
if(!isset($_SESSION['zalogowany']))
{
  header('Location:logowanie.php');
  exit();
}
if($_SESSION['admin']>0)
{
}
else
{
  header('Location:panel.php');
}

 ?>
<!DOCTYPE html>

<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/full-width-pics.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Panel Administracyjny</title>
    <style>
    .table{
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 1%;
}

.table td,th {
    font-size: 14px;
    border-top: 1px solid #ddd;
    padding: 5px 12px;
    text-align: left;
    vertical-align: top;
}

.table tbody tr:nth-child(even) td {
    background-color: #f3f3f3;
}
    </style>
  </head>
  <body style="padding-top:70px;">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="paneladmin.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="zgloszenia.php">Zgłoszenia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rejestracja.php">Stwórz nowego pracownika</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="pracownicy.php">Pracownicy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Wyloguj się</a>
            </li>


          </ul>
        </div>
      </div>
    </nav>
    <div class="col-12">
    <?php
    echo "<h1>"."<p>Witaj ".$_SESSION['user']."!</p>"."</h1>";
    echo "<h5>"."<p>Twój adres email: ".$_SESSION['email']."</p>"."</h5>";
    echo "<h5>"."<p>Witam ".$_SESSION['imiepracownika']." ".$_SESSION['nazwiskopracownika']."</p>"."</h5>";
    echo "<h5>"."<p>Twój numer telefonu to: ".$_SESSION['numerpracownika']."</p>"."</h5>";
    echo "<h5 class='text-center'>"."<p>Aktualne rezerwacje</p>"."</h5>";
    $conn = @new mysqli($host,$db_user,$db_password,$db_name);

    if($conn->connect_errno!=0)
    {
      echo "ERROR:".$conn->connect_errno;
    }
    else
    {
      $danerzbazy=$conn->query("SELECT * FROM rezerwacje");
      if($danerzbazy->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
				echo "<tr>";
				echo "<th>ID REZERWACJI</th>";
				echo "<th>IMIE</th>";
				echo "<th>NAZWISKO</th>";
        echo "<th>NUMER      </th>";
        echo "<th>EMAIL</th>";
        echo "<th>NAZWA POKOJU</th>";
        echo "<th>DATA PRZYJAZDU</th>";
        echo "<th>Data odjazdu</th>";
        echo "<th>ILOŚĆ NOCY</th>";
        echo "<th>CAŁKOWITY KOSZT</th>";
        echo "<th>AKCEPTUJ REZERWACJE</th>";
        echo "<th>ODRZUĆ REZERWACJE</th>";

				echo "</tr>";
        while($row=$danerzbazy->fetch_assoc())
        {
          $idd=$row['id_klienta'];
          $pkk=$row['id_pokoju'];
          $danekzbazy=$conn->query("SELECT * FROM klienci WHERE id_klienta='$idd'");
          $danek=$danekzbazy->fetch_assoc();
          $danepzbazy=$conn->query("SELECT * FROM pokoje WHERE id_pokoju='$pkk'");
          $danep=$danepzbazy->fetch_assoc();
          $imie=$danek['imie'];
          $nazwisko=$danek['nazwisko'];
          $numer=$danek['numer'];
          $email=$danek['email'];
          $nazwa_pokoju=$danep['nazwa_pokoju'];
          $idKlienta=$danek['id_klienta'];
          $idPokoju=$danep['id_pokoju'];
          echo "<tr>";

          echo "<td>" . $row['id_rezerwacji'] .'    '. "</td>";
          echo "<td>" . $imie ."</td>";
          echo "<td>" . $nazwisko. "</td>";
          echo "<td>" . $numer. "</td>";
          echo "<td>" . $email. "</td>";
          echo "<td>" . $nazwa_pokoju. "</td>";
          echo "<td>" . $row['od']. "</td>";
          echo "<td>" . $row['do']. "</td>";
          echo "<td>" . $row['ilosc_dni']. "</td>";
          echo "<td>" . $row['cenarazem']. "</td>";
          echo "<td><a href='raccept.php?id=".$row['id_rezerwacji']."'><button>Akcpetuj</button></a></td>";
          echo "<td><a href='usunrezerwacje.php?id=".$row['id_rezerwacji']."'><button>Usuń</button></a></td>";


          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
      else {
        echo "Nie ma żadnych rezerwacji";
      }

/////--------------------------
  echo "<h5 class='text-center'>"."<p>Aktualne zaakceptowane rezerwacje</p>"."</h5>";
      $danerazbazy=$conn->query("SELECT * FROM raccept");
      if($danerazbazy->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
				echo "<tr>";
				echo "<th>ID Rezerwacji</th>";
				echo "<th>Imię</th>";
				echo "<th>Nazwisko</th>";
        echo "<th>Numer</th>";
        echo "<th>Email</th>";
        echo "<th>Edytuj Dane klienta</th>";
        echo "<th>Nazwa pokoju</th>";
        echo "<th>Data przyjazdu</th>";
        echo "<th>Data odjazdu</th>";
        echo "<th>Ilość nocy</th>";
        echo "<th>Całkowity koszt</th>";
        echo "<th>ODRZUĆ REZERWACJE</th>";
        echo "<th>Aktualizuj</th>";

				echo "</tr>";
        while($row=$danerazbazy->fetch_assoc())
        {
          $iddd=$row['id_klienta'];
          $pkkk=$row['id_pokoju'];
          $danekzbazy=$conn->query("SELECT * FROM klienci  WHERE id_klienta='$iddd'");
          $danek=$danekzbazy->fetch_assoc();
          $danepzbazy=$conn->query("SELECT * FROM pokoje WHERE id_pokoju='$pkkk'");
          $danep=$danepzbazy->fetch_assoc();
          $imie=$danek['imie'];
          $nazwisko=$danek['nazwisko'];
          $numer=$danek['numer'];
          $email=$danek['email'];
          $nazwa_pokoju=$danep['nazwa_pokoju'];
          $idKlienta=$danek['id_klienta'];
          $idPokoju=$danep['id_pokoju'];
          echo "<tr>";

          echo "<td>" . $row['id_rezerwacji'] .'    '. "</td>";
          echo "<td>" . $imie ."</td>";
          echo "<td>" . $nazwisko. "</td>";
          echo "<td>" . $numer. "</td>";
          echo "<td>" . $email. "</td>";
          echo "<td><a href='updateklient.php?id=".$row['id_klienta']."'><button>Edytuj Dane Klienta</button></a></td>";
          echo "<td>" . $nazwa_pokoju. "</td>";
          echo "<td>" . $row['od']. "</td>";
          echo "<td>" . $row['do']. "</td>";
          echo "<td>" . $row['ilosc_dni']. "</td>";
          echo "<td>" . $row['cenarazem']. "</td>";
          echo "<td><a href='usunrezerwacjea.php?id=".$row['id_rezerwacji']."'><button>Usuń</button></a></td>";
          echo "<td><a href='update.php?id=".$row['id_rezerwacji']."'><button>Aktualizuj</button></a></td>";

          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
      else {
        echo "Nie ma żadnych rezerwacji";
      }


      $conn->close();
    }
    ?>
  </div>



  </body>
</html>
