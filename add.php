<?php
include('functions.php');
secured();
$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count_id = $_POST['count_id'];
    $location_name = $_POST['location_name'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $direction = $_POST['direction'];
    $motorbike = $_POST['vol_fwha1_motorbike'];
    $cars = $_POST['vol_fwha2_cars'];
    $pickups = $_POST['vol_fwha3_pickups'];
    $buses = $_POST['vol_fwha4_buses'];

    $stmt = $conn->prepare("INSERT INTO raw_class (count_id, location_name, time_start, time_end, direction, vol_fwha1_motorbike, vol_fwha2_cars, vol_fwha3_pickups, vol_fwha4_buses) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $count_id, $location_name, $time_start, $time_end, $direction, $motorbike, $cars, $pickups, $buses);
    $stmt->execute();

    header("Location: display_class.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
</head>
<body>
<h1>Add Traffic Class Entry</h1>
<form method="post">
    <input type="text" name="count_id" placeholder="Count ID" required>
    <input type="text" name="location_name" placeholder="Location" required>
    <input type="datetime-local" name="time_start" required>
    <input type="datetime-local" name="time_end" required>
    <input type="text" name="direction" placeholder="Direction" required>
    <input type="number" name="vol_fwha1_motorbike" placeholder="Motorbikes">
    <input type="number" name="vol_fwha2_cars" placeholder="Cars">
    <input type="number" name="vol_fwha3_pickups" placeholder="Pickups">
    <input type="number" name="vol_fwha4_buses" placeholder="Buses">
    <input type="submit" value="Add Record">
</form>
</body>
</html>