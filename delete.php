<?php
include('functions.php');
secured();
$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM raw_class WHERE id = $id");
    header("Location: display_class.php");
    exit();
}
?>