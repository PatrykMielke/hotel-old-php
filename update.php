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
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  echo "<h5 class='text-center'>"."<p>Aktualna rezerwacja do edycji</p>"."</h5>";
      $danerazbazy=$conn->query("SELECT * FROM raccept WHERE id_rezerwacji=$id");
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
        echo "<th class='edit'>Nazwa pokoju</th>";
        echo "<th class='edit'>Data przyjazdu</th>";
        echo "<th class='edit'>Data odjazdu</th>";
        echo "<th>Ilość nocy</th>";
        echo "<th>Całkowity koszt</th>";
        echo "<th>Odrzuć rezerwacje</th>";
        echo "<th>Aktualizuj</th>";

				echo "</tr>";
        while($row=$danerazbazy->fetch_assoc())
        {
          $danekzbazy=$conn->query("SELECT * FROM klienci,raccept WHERE klienci.id_klienta=raccept.id_klienta");
          $danek=$danekzbazy->fetch_assoc();
          $danepzbazy=$conn->query("SELECT * FROM pokoje,raccept WHERE pokoje.id_pokoju=raccept.id_pokoju");
          $danep=$danepzbazy->fetch_assoc();
          $imie=$danek['imie'];
          $nazwisko=$danek['nazwisko'];
          $numer=$danek['numer'];
          $email=$danek['email'];

          $nazwa_pokoju=$danep['nazwa_pokoju'];
          $idKlienta=$danek['id_klienta'];
          $idPokoju=$danep['id_pokoju'];
          $od=$row['od'];
          $do=$row['do'];
          echo "<tr>";

          echo "<td>" . $row['id_rezerwacji'] .'    '. "</td>";
          echo "<td>" . $imie ."</td>";
          echo "<td>" . $nazwisko. "</td>";
          echo "<td>" . $numer. "</td>";
          echo "<td>" . $email. "</td>";
          echo "<td class='edit'>" . $nazwa_pokoju. "</td>";
          echo "<td class='edit'>" . $row['od']. "</td>";
          echo "<td class='edit'>" . $row['do']. "</td>";
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
        echo "Błąd rezerwacji";
        header('Location: paneladmin.php');
        exit();

      }
 ?>
 <form class="rezerwacja" action="#" method="POST">
 <div class="col-md-4">

   Wybierz Pokój:</br>
 <select name="wybranyPokoj">
   <option value="pusto"></option>
  <option value="Pokoj Krolewski">Pokoj Krolewski</option>
  <option value="Pokoj Szlachecki">Pokoj Szlachecki</option>
  <option value="Pokoj Wielki">Pokoj Wielki</option>
  <option value="Pokoj Duzy">Pokoj Duzy</option>
</select>

</div>
<div class="col-md-4">
</br>
Data przyjazdu:</br>
<input type="date" name="dataod" value="<?php echo $od; ?>" required>
</div>
<div class="col-md-4">
</br>
Data wyjazdu:</br>
<input type="date" name="datado" value="<?php echo $do; ?>"  required ></br>
<?php
if(isset($_SESSION['e_datyy']))
{
  echo '<div class="error">'.$_SESSION['e_datyy'].'</div>';
  unset($_SESSION['e_datyy']);
}
?>

<input type="submit" name="submit" value="Aktualizuj">
</div>
</form>
<?php

if(isset($_POST["submit"]))
{
  require_once 'connect.php';
  $conn = new mysqli($host,$db_user,$db_password,$db_name);
  $wybranyPokoj = $_POST["wybranyPokoj"];
  $dataod = $_POST["dataod"];
  $datado = $_POST["datado"];
  $zapytanieDoPokoju = $conn->query("SELECT * FROM pokoje Where nazwa_pokoju='$wybranyPokoj'");
  $wierszDoPokoju = $zapytanieDoPokoju->fetch_assoc();
  $idPokoju = $wierszDoPokoju['id_pokoju'];
  $cena=$wierszDoPokoju['cena'];
  $cena=1000;
  $data=date("Y-m-d");
$ok=false;
$dataok=false;
$dataok2=false;
$datapoprawna=true;
$zmianaod=false;
$zmianado=false;
$zmianaobie=false;
$datapoprawnaa=true;


if($zapytanieDoPokoju->num_rows>0)
{
  $noweidpokoju=$wierszDoPokoju['id_pokoju'];
  $ok=true;
}
//////////////////
if($dataod!=$od)
{
  $nowadataod=$dataod;
  $dataok=true;
  if($nowadataod<$data)
  {
    $datapoprawnaa=false;
  }

}
/////////////////
if($datado!=$do)
{
  $nowadatado=$datado;
  $dataok2=true;
}
////////////////////
if(($dataok==true)&&($dataok2==true))
{
  if($nowadataod<$nowadatado)
  {
    $zmianaobie=true;
  }
  else{
    $datapoprawna=false;
  }
}
//////////////////
if(($dataok==true)&&($dataok2==false))
{
  if($nowadataod<$do)
  {
    $zmianaod=true;
  }
  else {
    $datapoprawna=false;
  }
}
/////////////////
if(($dataok==false)&&($dataok2==true))
{
  if($od<$nowadatado)
  {
    $zmianado=true;
  }
  else {
    $datapoprawna=false;
  }
}
//////////////////
if($dataod<$data)
{
  $datapoprawnaa=false;
}




if(($ok==true)&&($zmianaobie==false)&&($zmianaod==false)&&($zmianado==false))
{
  $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$noweidpokoju' and (od <= '$datado') and ('$dataod' <= do) ");
  $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
  $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$noweidpokoju' and (od <= '$datado') and ('$dataod' <= do) ");
  $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
  if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
  {

    echo "<script>
alert('Nie udało się zmienić rezerwacji ta data jest zajęta');
window.location.href='paneladmin.php';
</script>";
  }
  else {
    $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju' WHERE id_rezerwacji='$id'");
    if($odp)
    {
      echo  "<script>
 alert('Udalo sie dokonac aktualizacji');
 window.location.href='paneladmin.php';
 </script>";
$conn->close();
    }
    else {
      echo  "<script>
 alert('Nie udalo sie dokonac aktualizacji');
 window.location.href='paneladmin.php';
 </script>";
$conn->close();
    }
  }
}


if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==true)&&($zmianaod==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$noweidpokoju' and (od <= '$do') and ('$nowadataod' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$noweidpokoju' and (od <= '$do') and ('$nowadataod' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$nowadataod");
    $later=new DateTime("$do");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', od='$nowadataod', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', od='$nowadataod', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }

}

if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==true)&&($zmianado==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$noweidpokoju' and (od <= '$nowadatado') and ('$od' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$noweidpokoju' and (od <= '$nowadatado') and ('$od' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$od");
    $later=new DateTime("$nowadatado");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }

}

if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==true)&&($zmianaobie==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$noweidpokoju' and (od <= '$nowadatado') and ('$nowadataod' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$noweidpokoju' and (od <= '$nowadatado') and ('$nowadataod' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$nowadataod");
    $later=new DateTime("$nowadatado");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', od='$nowadataod', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET id_pokoju='$noweidpokoju', od='$nowadataod', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }

}

if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==false)&&($zmianaod==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$idPokoju' and (od <= '$do') and ('$nowadataod' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$idPokoju' and (od <= '$do') and ('$nowadataod' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$nowadataod");
    $later=new DateTime("$do");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET od='$nowadataod', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET od='$nowadataod', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }

}

if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==false)&&($zmianado==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$idPokoju' and (od <= '$nowadatado') and ('$od' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$idPokoju' and (od <= '$nowadatado') and ('$od' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$od");
    $later=new DateTime("$nowadatado");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }
}

if(($datapoprawna==true)&&($datapoprawnaa==true))
{
  if(($ok==false)&&($zmianaobie==true))
  {
    $wyciaganiedatyzbazy =("SELECT * from rezerwacje WHERE id_pokoju='$idPokoju' and (od <= '$nowadatado') and ('$nowadataod' <= do) ");
    $datazbazy = mysqli_query($conn,$wyciaganiedatyzbazy);
    $wyciaganiedatyrzbazy =("SELECT * from raccept WHERE id_pokoju='$idPokoju' and (od <= '$nowadatado') and ('$nowadataod' <= do) ");
    $datarzbazy = mysqli_query($conn,$wyciaganiedatyrzbazy);
    $daner=$datarzbazy->fetch_assoc();
    $earlier=new DateTime("$nowadataod");
    $later=new DateTime("$nowadatado");
    $diff=$later->diff($earlier)->format("%a");
    $cenarazem=$diff*$cena;
    if((mysqli_num_rows($datazbazy)>0)||(mysqli_num_rows($datarzbazy)>0))
    {
      if($row['id_rezerwacji']==$id)
      {
        $odp=$conn->query("UPDATE raccept SET od='$nowadataod', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem'  WHERE id_rezerwacji='$id'");
        if($odp)
        {
          echo  "<script>
     alert('Udalo sie dokonac aktualizacji');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
        else {
          echo  "<script>
     alert('Nie udalo sie dokonac aktualizacjiii');
     window.location.href='paneladmin.php';
     </script>";
    $conn->close();
        }
      }
    }
    else {
      $odp=$conn->query("UPDATE raccept SET od='$nowadataod', do='$nowadatado', ilosc_dni='$diff', cenarazem='$cenarazem' WHERE id_rezerwacji='$id'");
      if($odp)
      {
        echo  "<script>
   alert('Udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
      else {
        echo  "<script>
   alert('Nie udalo sie dokonac aktualizacji');
   window.location.href='paneladmin.php';
   </script>";
  $conn->close();
      }
    }
  }
}


if($datapoprawna==false)
{
  $_SESSION['e_datyy']="Data przyjazdu musi być większa od daty wyjazdu";
}
if($datapoprawnaa==false)
{
  $_SESSION['e_datyy']="Data nie moze być z przeszłości";
}


}
$conn->close();
 ?>
</div>



</body>
</html>
