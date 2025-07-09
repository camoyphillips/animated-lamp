<?php
require 'connection.php';

$sql = "
SELECT 
  count_id,
  location_name,
  direction,
  time_start,
  vol_fwha1_motorbike,
  vol_fwha2_cars,
  vol_fwha3_pickups,
  vol_fwha4_buses
FROM raw_class
ORDER BY time_start DESC
LIMIT 100
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vehicle Class Breakdown</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
    h1 { text-align: center; margin-bottom: 20px; }

    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background-color: #444; color: #fff; }
    .highlight { background-color: #e3f7d4; }

    @media screen and (max-width: 600px) {
      table, thead, tbody, th, td, tr { display: block; }
      th { display: none; }
      td {
        padding-left: 50%;
        position: relative;
        text-align: right;
        border: none;
        border-bottom: 1px solid #ccc;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
      }
    }
  </style>
</head>
<body>
  <main role="main">
    <h1>Vehicle Volume by Class (raw_class)</h1>

    <table aria-label="Vehicle Class Volume Table">
      <thead>
        <tr>
          <th>Location</th>
          <th>Direction</th>
          <th>Time</th>
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
              <td data-label="Location"><?= htmlspecialchars($row['location_name']) ?></td>
              <td data-label="Direction"><?= htmlspecialchars($row['direction']) ?></td>
              <td data-label="Time"><?= htmlspecialchars($row['time_start']) ?></td>
              <td data-label="Motorbikes"><?= htmlspecialchars($row['vol_fwha1_motorbike']) ?></td>
              <td data-label="Cars"><?= htmlspecialchars($row['vol_fwha2_cars']) ?></td>
              <td data-label="Pickups"><?= htmlspecialchars($row['vol_fwha3_pickups']) ?></td>
              <td data-label="Buses"><?= htmlspecialchars($row['vol_fwha4_buses']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7">No data found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>
</body>
</html>

<?php $conn->close(); ?>