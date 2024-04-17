<?php
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$zapytanie2=$conn->query("SELECT * FROM uzytkownicy WHERE id_uzytkownika='$id'");
$tablica2=$zapytanie2->fetch_assoc();
$imie=$tablica2['imie'];
$nazwisko=$tablica2['nazwisko'];
$email=$tablica2['email'];
$numer=$tablica2['numer'];
$usuniety = "INSERT INTO uzytkownicy_zwolnieni (imie,nazwisko,email,numer) VALUES ('$imie','$nazwisko','$email','$numer')";
if (mysqli_query($conn, $usuniety))
{
$sql = "DELETE  FROM uzytkownicy WHERE id_uzytkownika='$id'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo "<script> alert('Pracownik usunięty pomyślnie')</script>";
    header('Location: pracownicy.php');
    exit;
} else {
    echo "Error deleting record";
    echo "<script> alert('Pracownika nie udało się usunąć')</script>";
    header('Location:pracownicy.php');
}
}
else
{
  echo "Error deleting record";
  echo "<script> alert('Pracownika nie udało się usunąć')</script>";
  header('Location:pracownicy.php');
}
 ?>
