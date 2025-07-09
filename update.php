<?php
require('functions.php');
secured();
$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM raw_class WHERE count_id = $id");
    $record = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $location = $_POST['location_name'];
    $motorbike = $_POST['vol_fwha1_motorbike'];

    $stmt = $conn->prepare("UPDATE raw_class SET location_name=?, vol_fwha1_motorbike=? WHERE count_id=?");
    $stmt->bind_param("sii", $location, $motorbike, $id);
    $stmt->execute();
    header('Location: display_class.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Raw Class</title>
</head>
<body>
  <h1>Update Record</h1>
  <form method="POST">
    <input type="hidden" name="id" value="<?= $record['count_id'] ?>">
    <label>Location: <input type="text" name="location_name" value="<?= $record['location_name'] ?>" required></label><br>
    <label>Motorbikes: <input type="number" name="vol_fwha1_motorbike" value="<?= $record['vol_fwha1_motorbike'] ?>"></label><br>
    <button type="submit">Update</button>
  </form>
</body>
</html>