<?php
require 'connection.php';

// Filters for minimum volume for traffic-app
$minVolume = $_GET['min_volume'] ?? '';

$where = [];
if (!empty($minVolume) && is_numeric($minVolume)) {
    $where[] = "v.volume_15min >= " . intval($minVolume);
}
$whereClause = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "
SELECT 
  v.count_id,
  v.location_name,
  v.direction,
  v.volume_15min,
  v.time_start,
  c.vol_fwha1_motorbike,
  c.vol_fwha2_cars,
  c.vol_fwha3_pickups,
  c.vol_fwha4_buses
FROM raw_volume v
LEFT JOIN raw_class c ON v.count_id = c.count_id
$whereClause
ORDER BY v.time_start DESC
LIMIT 100
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Traffic Volume by Vehicle Type</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
    h1 { text-align: center; margin-bottom: 10px; }
    form { text-align: center; margin-bottom: 20px; }
    input { padding: 5px; }
    button, .reset-button {
      margin-left: 10px;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button { background-color:#007bff; color: white; }
    button:hover { background-color: #0056b3; }
    .reset-button { background-color: #dc3545; color: white; }
    .reset-button:hover { background-color: #c82333; }

    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background-color: #333; color: #fff; }
    .high-volume { background-color: #ffeeba; font-weight: bold; }

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
  <h1>Traffic Volume by Vehicle Class</h1>

  <form method="get" action="display_join.php" aria-label="Volume Filter Form">
    <label for="min_volume">Min 15min Volume:</label>
    <input type="number" name="min_volume" id="min_volume" value="<?= htmlspecialchars($minVolume) ?>" placeholder="e.g. 1000" />
    <button type="submit">Apply Filter</button>
    <a href="display_join.php"><button type="button" class="reset-button">Reset</button></a>
  </form>

  <table aria-label="Traffic Volume and Vehicle Types">
    <thead>
      <tr>
        <th>Location</th>
        <th>Direction</th>
        <th>Time</th>
        <th>Volume (15min)</th>
        <th>Motorbikes</th>
        <th>Cars</th>
        <th>Pickups</th>
        <th>Buses</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php $rowClass = ($row['volume_15min'] > 1000) ? 'high-volume' : ''; ?>
          <tr class="<?= $rowClass ?>">
            <td data-label="Location"><?= htmlspecialchars($row['location_name']) ?></td>
            <td data-label="Direction"><?= htmlspecialchars($row['direction']) ?></td>
            <td data-label="Time"><?= htmlspecialchars($row['time_start']) ?></td>
            <td data-label="15min Volume"><?= htmlspecialchars($row['volume_15min']) ?></td>
            <td data-label="Motorbikes"><?= htmlspecialchars($row['vol_fwha1_motorbike'] ?? 'N/A') ?></td>
            <td data-label="Cars"><?= htmlspecialchars($row['vol_fwha2_cars'] ?? 'N/A') ?></td>
            <td data-label="Pickups"><?= htmlspecialchars($row['vol_fwha3_pickups'] ?? 'N/A') ?></td>
            <td data-label="Buses"><?= htmlspecialchars($row['vol_fwha4_buses'] ?? 'N/A') ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="8">No data found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>
</body>
</html>

<?php $conn->close(); ?>
