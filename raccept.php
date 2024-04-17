<?php
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);
$zapytanie1=$conn->query("SELECT * FROM rezerwacje WHERE id_rezerwacji='$id'");
$tablica1=$zapytanie1->fetch_assoc();
$idKlienta=$tablica1['id_klienta'];
$idPokoju=$tablica1['id_pokoju'];
$od=$tablica1['od'];
$do=$tablica1['do'];
$ilosc=$tablica1['ilosc_dni'];
$cena=$tablica1['cenarazem'];
$zapytanie2=$conn->query("SELECT * FROM klienci WHERE id_klienta='$idKlienta'");
$tablica2=$zapytanie2->fetch_assoc();
$mail=$tablica2['email'];
$imie=$tablica2['name'];
$nazwisko=$tablica2['nazwisko'];



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO raccept(id_klienta,id_pokoju,od,do,ilosc_dni,cenarazem) VALUES ('$idKlienta','$idPokoju','$od','$do','$ilosc','$cena')";

if (mysqli_query($conn, $sql)) {

  $to     = $mail;
  $name   = 'Hotel VICTORIA';
  $subject = 'Potwierdzenie rezerwacji';
  $message = 'Chcemy poinformować, że Pańska rezerwacja została zaakceptowana. Całkowita cena za: '.$ilosc.'dni.'.'Wynosi: '.$cena.'Dziękujemy za skorzystanie z naszych usług.';
  $headers = 'Od: ' . 'Hotel Victoria';
  $headers .= "Content-Type: text/html; charset=utf-8\r\n;";



  mail($to, $subject, $message, $headers);

    mysqli_close($conn);
    echo "<script>
  alert('Udało się zmienić zawartość tabeli klient');
  </script>";
    header("Location: usunrezerwacje.php?id=".$id);
    exit;
} else {
    echo "Error deleting record";
    echo "<script> alert('Nie udało się dodać rezerwacji')</script>";
    header('Location: paneladmin.php');
}
 ?>
