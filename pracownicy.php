<?php session_start();
 require_once 'connect.php';
 if(!isset($_SESSION['zalogowany']))
 {
   header('Location:logowanie.php');
   exit();
 }

  ?>
  <?php
  if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
  {
    if($_SESSION['admin']>0)
            {
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
    echo "<h5>"."<p>Witam Panie ".$_SESSION['imiepracownika']." ".$_SESSION['nazwiskopracownika']."</p>"."</h5>";
    echo "<h5>"."<p>Twój numer telefonu to: ".$_SESSION['numerpracownika']."</p>"."</h5>";
    echo "<h5 class='text-center'>"."<p>Pracownicy</p>"."</h5>";
    $conn = @new mysqli($host,$db_user,$db_password,$db_name);

    if($conn->connect_errno!=0)
    {
      echo "ERROR:".$conn->connect_errno;
    }
    else
    {
      $danepracownik=$conn->query("SELECT * FROM uzytkownicy");
      if($danepracownik->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
				echo "<tr>";
				echo "<th>ID PRACOWNIKA</th>";
        echo "<th>Nazwa Użykownika</th>";
				echo "<th>IMIE</th>";
				echo "<th>NAZWISKO</th>";
        echo "<th>NUMER</th>";
        echo "<th>EMAIL</th>";
        echo "<th>Administrator</th>";
        echo "<th>Edytuj dane pracownika</th>";
        echo "<th>Zwolnij</th>";

				echo "</tr>";
        while($row=$danepracownik->fetch_assoc())
        {
            if($row['czy_admin']==1)
            {
              $czyadmin="TAK";
            }
            else
            {
              $czyadmin="NIE";
            }
          echo "<tr>";
          echo "<td>" . $row['id_uzytkownika']. "</td>";
          echo "<td>" . $row['user'] ."</td>";
          echo "<td>" . $row['imie']. "</td>";
          echo "<td>" . $row['nazwisko']. "</td>";
          echo "<td>" . $row['numer']. "</td>";
          echo "<td>" . $row['email']. "</td>";
          echo "<td>" . $czyadmin. "</td>";
          echo "<td><a href='updatepracownik.php?id=".$row['id_uzytkownika']."'><button>Edytuj dane</button></a></td>";
          echo "<td><a href='usunpracownik.php?id=".$row['id_uzytkownika']."'><button>Usuń</button></a></td>";

          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

      }
      else {
        echo "Nie ma żadnych pracowników";
      }
      echo "<h5 class='text-center'>"."<p>Pracownicy usunięci</p>"."</h5>";

      $danepraconikusuniety=$conn->query("SELECT * FROM uzytkownicy_zwolnieni");
      if($danepraconikusuniety->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>ID PRACOWNIKA</th>";
        echo "<th>IMIE</th>";
        echo "<th>NAZWISKO</th>";
        echo "<th>NUMER</th>";
        echo "<th>EMAIL</th>";
        echo "</tr>";
        while($row1=$danepraconikusuniety->fetch_assoc())
        {
          echo "<tr>";
          echo "<td>" . $row1['id_uzytkownika']. "</td>";
          echo "<td>" . $row1['imie']. "</td>";
          echo "<td>" . $row1['nazwisko']. "</td>";
          echo "<td>" . $row1['numer']. "</td>";
          echo "<td>" . $row1['email']. "</td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
      else {
          echo "Nie ma żadnych usunietych pracowników";
      }







      $conn->close();
    }

    ?>
  </div>



  </body>
</html>
