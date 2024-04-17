<?php
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE  FROM rezerwacje WHERE id_rezerwacji='$id'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo "<script> alert('Rezerwacja została odrzucona')</script>";
    header('Location: paneladmin.php');
    exit;
} else {
    echo "Error deleting record";
    echo "<script> alert('Nie udało się usunąć rezerwacji')</script>";
    header('Location: paneladmin.php');
}
 ?>
