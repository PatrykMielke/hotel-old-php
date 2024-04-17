<?php
$id = $_GET['id'];

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE  FROM zgloszenia WHERE id_zgloszenia='$id'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo "<script> alert('Zgloszenie usuniete pomyślnie')</script>";
    header('Location: zgloszenia.php');
    exit;
} else {
    echo "Error deleting record";
    echo "<script> alert('Zgloszenia nie udało się usunąć')</script>";
    header('Location:zgloszenia.php');
}
 ?>
