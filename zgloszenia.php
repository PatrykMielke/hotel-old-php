<?php session_start();
require_once 'connect.php';
if(!isset($_SESSION['zalogowany']))
{
  header('Location:logowanie.php');
  exit();
}

 ?>
<!DOCTYPE html>

<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel kontrolny </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/full-width-pics.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Panel Pracowniczy</title>
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
    echo "<h5 class='text-center'>"."<p>Aktualne zgłoszenia</p>"."</h5>";
    $conn = @new mysqli($host,$db_user,$db_password,$db_name);

    if($conn->connect_errno!=0)
    {
      echo "ERROR:".$conn->connect_errno;
    }
    else
    {
      $danerzbazy=$conn->query("SELECT * FROM zgloszenia");
      if($danerzbazy->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
				echo "<tr>";
				echo "<th>ID Zgłoszenia</th>";
				echo "<th>Dane </th>";
				echo "<th>Email</th>";
        echo "<th>Temat     </th>";
        echo "<th>Treść</th>";
        echo "<th>Usuń Zgłoszenie</th>";
				echo "</tr>";
        while($row=$danerzbazy->fetch_assoc())
        {
          echo "<tr>";

          echo "<td>" . $row['id_zgloszenia'] . "</td>";
          echo "<td>" . $row['dane'] ."</td>";
          echo "<td>" . $row['email']. "</td>";
          echo "<td>" . $row['temat']. "</td>";
          echo "<td>" . $row['tresc']. "</td>";
          echo "<td><a href='usunzgloszenie.php?id=".$row['id_zgloszenia']."'><button>Usuń</button></a></td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

      }
      else {
        echo "Nie ma żadnych zgłoszeń";
      }







      $conn->close();
    }

    ?>
  </div>

  </body>
</html>
