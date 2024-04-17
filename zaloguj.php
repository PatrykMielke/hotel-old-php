<?php
session_start();
require_once 'connect.php';

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
  header('Location:logowanie.php');
  exit();
}

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if($conn->connect_errno!=0)
{
  echo "ERROR:".$conn->connect_errno;
  exit();
}
else
{
  $login = $_POST['login'];
  $haslo = $_POST['haslo'];

  $login = htmlentities($login,ENT_QUOTES, "UTF-8");

  if($rezultat=$conn->query(sprintf("SELECT * FROM uzytkownicy where user='%s'",mysqli_real_escape_string($conn,$login))))
  {
    $ilu_userow=$rezultat->num_rows;
    if($ilu_userow>0)
    {
      $wiersz=$rezultat->fetch_assoc();

      if(password_verify($haslo,$wiersz['pass']))
      {

          $_SESSION['zalogowany']=true;
          $_SESSION['id']=$wiersz['id_uzytkownika'];
          $_SESSION['user']=$wiersz['user'];
          $_SESSION['email']=$wiersz['email'];
          $_SESSION['admin']=$wiersz['czy_admin'];
          $_SESSION['imiepracownika']=$wiersz['imie'];
          $_SESSION['nazwiskopracownika']=$wiersz['nazwisko'];
          $_SESSION['numerpracownika']=$wiersz['numer'];

          unset($_SESSION['blad']);
          $rezultat->close();
          if($_SESSION['admin']>0)
          {
            header('Location:paneladmin.php');
          }
          else
          {
            header('Location:panel.php');
          }

    }
    else
    {
      $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: logowanie.php');
    }
    }
    else
    {
      $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: logowanie.php');
    }
  }



  $conn->close();
}





 ?>

