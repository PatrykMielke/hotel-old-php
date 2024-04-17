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
    .edit
    {
      border: 1px solid red;
      color:red;
    }
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
.error{
  color:red;
  margin-top: 10px;
  margin-bottom: 10px;
}
    </style>
  </head>
  <body style="padding-top:70px;">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="panel.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
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
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  echo "<h5 class='text-center'>"."<p>Aktualn klient do edycji</p>"."</h5>";
      $danerazbazy=$conn->query("SELECT * FROM klienci WHERE id_klienta=$id");
      if($danerazbazy->num_rows>0)
      {
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
				echo "<tr>";
				echo "<th>ID Klienta</th>";
				echo "<th>Imię</th>";
				echo "<th>Nazwisko</th>";
        echo "<th>Numer</th>";
        echo "<th>Email</th>";
				echo "</tr>";
        while($row=$danerazbazy->fetch_assoc())
        {
          $danekzbazy=$conn->query("SELECT * FROM klienci WHERE id_klienta='$id'");
          $danek=$danekzbazy->fetch_assoc();
          $imie=$danek['imie'];
          $nazwisko=$danek['nazwisko'];
          $numer=$danek['numer'];
          $email=$danek['email'];

          echo "<tr>";
          echo "<td>" . $row['id_klienta'] .'    '. "</td>";
          echo "<td>" . $imie ."</td>";
          echo "<td>" . $nazwisko. "</td>";
          echo "<td>" . $numer. "</td>";
          echo "<td>" . $email. "</td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
      else {
        echo "Błąd Klienta";
        header('Location: paneladmin.php');
        exit();

      }
 ?>
 <form class="rezerwacja" action="#" method="POST">
<div class="col-md-4">
   Imię:</br>
 <input name="imie" type="text">
 </div>
   <div class="col-md-4">
   Nazwisko: </br>
 <input name="nazwisko" type="text">
 </div>
   <div class="col-md-4">
   Numer telefonu:</br>
 <input name="numer" type="text">
 </div>
   <div class="col-md-4">
   Email: </br>
 <input name="email" type="text"><br/><br/>
 </div>
 <input type="submit" name="submit" value="Aktualizuj">
</form>

<?php

if(isset($_POST["submit"]))
{
  require_once 'connect.php';
  $conn = new mysqli($host,$db_user,$db_password,$db_name);
  $noweimie=$_POST['imie'];
  $nowenazwisko=$_POST['nazwisko'];
  $nowytelefon=$_POST['numer'];
  $nowyemail=$_POST['email'];
  $wszystkook=false;

  if(empty($noweimie))
  {
  }
  else {
    $odp=$conn->query("UPDATE klienci set imie='$noweimie' WHERE id_klienta='$id'");
    $wszystkook=true;
  }
  if(empty($nowenazwisko))
  {
  }
  else {
    $odp=$conn->query("UPDATE klienci set nazwisko='$nowenazwisko' WHERE id_klienta='$id'");
    $wszystkook=true;
  }
  if(empty($nowytelefon))
  {
  }
  else {
    $odp=$conn->query("UPDATE klienci set numer='$nowytelefon' WHERE id_klienta='$id'");
    $wszystkook=true;
  }
  if(empty($nowyemail))
  {
  }
  else {
    $odp=$conn->query("UPDATE klienci set email='$nowyemail' WHERE id_klienta='$id'");
    $wszystkook=true;
  }


  if($wszystkook==true)
  {
    echo "<script>
  alert('Udało się zmienić zawartość tabeli klient');
  window.location.href='paneladmin.php';
  </script>";
  }







}
$conn->close();
 ?>
</div>



</body>
</html>
