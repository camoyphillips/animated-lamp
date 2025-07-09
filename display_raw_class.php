<?php
require 'connection.php';

$sql = "SELECT * FROM raw_class ORDER BY time_start DESC LIMIT 100";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Raw Class Data</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f1f1f1; }
    h1 { text-align: center; }

    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    th { background: #555; color: #fff; }

    @media screen and (max-width: 600px) {
      table, thead, tbody, th, td, tr { display: block; }
      th { display: none; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        position: absolute;
        left: 10px;
      }
      td {
        position: relative;
        padding-left: 50%;
        text-align: right;
        border: none;
        border-bottom: 1px solid #ccc;
      }
    }
  </style>
</head>
<body>
  <h1>Raw Class Table</h1>

  <table>
    <thead>
      <tr>
        <th>Count ID</th>
        <th>Location</th>
        <th>Start</th>
        <th>End</th>
        <th>Direction</th>
        <th>Motorbikes</th>
        <th>Cars</th>
        <th>Pickups</th>
        <th>Buses</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td data-label="Count ID"><?= $row['count_id'] ?></td>
            <td data-label="Location"><?= $row['location_name'] ?></td>
            <td data-label="Start"><?= $row['time_start'] ?></td>
            <td data-label="End"><?= $row['time_end'] ?></td>
            <td data-label="Direction"><?= $row['direction'] ?></td>
            <td data-label="Motorbikes"><?= $row['vol_fwha1_motorbike'] ?></td>
            <td data-label="Cars"><?= $row['vol_fwha2_cars'] ?></td>
            <td data-label="Pickups"><?= $row['vol_fwha3_pickups'] ?></td>
            <td data-label="Buses"><?= $row['vol_fwha4_buses'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9">No data available.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>

<?php $conn->close(); ?>