<?php
session_start();
if($_SESSION['admin']>0)
{
  if(isset($_POST['email']))
  {
    //Udana walidacja
    $wszystko_OK=true;
    //Username
    $username=$_POST['username'];

    //sprawdzenie dlugosci Username
    if((strlen($username)<3)||(strlen($username)>20))
    {
      $wszystko_OK=false;
      $_SESSION['e_username']="Nazwa użytkownika musi posiadać od 3 do 20 znaków";
    }
    if(ctype_alnum($username)==false)
    {
      $wszystko_OK=false;
      $_SESSION['e_username']="Nazwa użytkownika może się składać tylko z liter i cyfr (bez polskich znaków)";
    }
    //Adres Email
    $email=$_POST['email'];
    $emailB= filter_var($email,FILTER_SANITIZE_EMAIL);

    if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
    {
      $wszystko_OK=false;
      $_SESSION['e_email']="Podaj poprawny adres email";
    }
    //hasla
    $haslo1=$_POST['haslo1'];
    $haslo2=$_POST['haslo2'];

    if((strlen($haslo1)<8)|| (strlen($haslo1)>20))
    {
      $wszystko_OK=false;
      $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
    }
    if($haslo1!=$haslo2)
    {
      $wszystko_OK=false;
      $_SESSION['e_haslo']="Hasła muszą być identyczne!";
    }
    $haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);

    $imiepracownika=$_POST['name'];
    $imiepracownika=htmlentities($imiepracownika,ENT_QUOTES,"UTF-8");
    $nazwiskopracownika=$_POST['surname'];
    $nazwiskopracownika=htmlentities($nazwiskopracownika,ENT_QUOTES,"UTF-8");
    $telefonpracownika=$_POST['number'];
    $telefonpracownika=htmlentities($telefonpracownika,ENT_QUOTES,"UTF-8");

//czy admin
    if(isset($_POST['admin']))
    {
      $czyadmin=1;
    }

    //recaptcha jezeli nie dziala to  extension=php_openssl.dll w php.ini

    $sekret="6LeJZ50UAAAAALBeyrGexsWs1lfrT_ttaqgE26_W";
    $sprawdz=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

    $odpowiedz=json_decode($sprawdz);

    if($odpowiedz->success==false)
    {
      $wszystko_OK=false;
      $_SESSION['e_bot']="Potwierdź że nie jesteś botem";
    }
    require_once "connect.php";
    //mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
      $conn =new mysqli($host,$db_user,$db_password,$db_name);
      if($conn->connect_errno!=0)
      {
        throw new Exception(mysqli_connect_errno());
      }
          else {
                  $rezultat=$conn->query("SELECT id_uzytkownika from uzytkownicy WHERE email='$email'");
                  if(!$rezultat)throw new Exception($conn->error);
                  $ilemail=$rezultat->num_rows;
                  if($ilemail>0)
                  {
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto z takim adresem email";
                  }

                  $rezultat=$conn->query("SELECT id_uzytkownika from uzytkownicy WHERE user='$username'");
                  if(!$rezultat)throw new Exception($conn->error);
                  $ileuser=$rezultat->num_rows;
                  if($ileuser>0)
                  {
                    $wszystko_OK=false;
                    $_SESSION['e_username']="Istnieje już konto z taką nazwą użytkownika";
                  }
                  $rezultat=$conn->query("SELECT id_uzytkownika from uzytkownicy WHERE numer='$telefonpracownika'");
                  if(!$rezultat)throw new Exception($conn->error);
                  $ileuser=$rezultat->num_rows;
                  if($ileuser>0)
                  {
                    $wszystko_OK=false;
                    $_SESSION['e_numer']="Istnieje już konto z takim numerem telefonu";
                  }
                  if($wszystko_OK==true)
                  {

                    if($conn->query("INSERT INTO uzytkownicy (user,pass,email,czy_admin,imie,nazwisko,numer) VALUES ('$username','$haslo_hash','$email','$czyadmin','$imiepracownika','$nazwiskopracownika','$telefonpracownika')"))
                    {
                      header('Location:paneladmin.php');
                    }
                    else {
                       throw new Exception($conn->error);
                    }


                  }



                  $conn->close();
                }
    } catch (Exception $e)
     {
      echo '<span style="color:red;">Błąd serwera!</span>';
      echo '<br/>Informacja Developerska:'.$e;
    }



  }
}
else
{
  header('Location:panel.php');
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/full-width-pics.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Tworzenie nowego pracownika</title>
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
              <a class="nav-link" href="paneladmin.php">Panel Administratora</a>
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
    <div class="container col-3">
    <form method="post">
        Nazwa Użytkownika:<br/> <input type="text" name="username"><br/>
        <?php
        if(isset($_SESSION['e_username']))
        {
          echo '<div class="error">'.$_SESSION['e_username'].'</div>';
          unset($_SESSION['e_username']);
        }
        ?>
        E-mail:<br/> <input type="email" name="email"><br/>
        <?php
        if(isset($_SESSION['e_email']))
        {
          echo '<div class="error">'.$_SESSION['e_email'].'</div>';
          unset($_SESSION['e_email']);
        }
        ?>
        Hasło:<br/> <input type="password" name="haslo1"><br/>
        <?php
        if(isset($_SESSION['e_haslo']))
        {
          echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
          unset($_SESSION['e_haslo']);
        }
        ?>
        Powtórz Hasło:<br/> <input type="password" name="haslo2"><br/>

        Imię:<br/> <input type="text" name="name"><br/>

        Nazwisko:<br/> <input type="text" name="surname"><br/>

        Numer Telefonu:<br/> <input type="number" name="number"><br/>
        <?php
        if(isset($_SESSION['e_numer']))
        {
          echo '<div class="error">'.$_SESSION['e_numer'].'</div>';
          unset($_SESSION['e_numer']);
        }
        ?>

        <br/><label><input type="checkbox" name="admin">Czy konto ma mieć uprawnienia Administratora?</label> <br/>

        <div class="g-recaptcha" data-sitekey="6LeJZ50UAAAAAMOO0hnGLehhxrIbylydf0qDBWZ-"></div>
        <?php
        if(isset($_SESSION['e_bot']))
        {
          echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
          unset($_SESSION['e_bot']);
        }
        ?>
        <br/>
        <input type="submit" value="Stwórz nowego pracownika">




    </form>
</div>
  </body>
</html>
