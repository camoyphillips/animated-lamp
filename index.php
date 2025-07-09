<?php
include('functions.php');
secured();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Traffic App Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="text-center mb-4">Toronto Traffic Data Dashboard</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

      <div class="col">
        <div class="card bg-primary text-white h-100 text-center">
          <div class="card-body">
            <a href="display_join.php" class="stretched-link text-white fw-bold">Join View: Volume + Class</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card bg-success text-white h-100 text-center">
          <div class="card-body">
            <a href="display_raw_class.php" class="stretched-link text-white fw-bold">Raw Class Table</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card bg-warning text-dark h-100 text-center">
          <div class="card-body">
            <a href="display_raw_volume.php" class="stretched-link text-dark fw-bold">Raw Volume Table</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card bg-info text-white h-100 text-center">
          <div class="card-body">
            <a href="add.php" class="stretched-link text-white fw-bold">Add Raw Class Data</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card bg-secondary text-white h-100 text-center">
          <div class="card-body">
            <a href="update.php" class="stretched-link text-white fw-bold">Update Raw Class</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card bg-danger text-white h-100 text-center">
          <div class="card-body">
            <a href="logout.php" class="stretched-link text-white fw-bold">Logout</a>
          </div>
        </div>
      </div>

    </div>

    <footer class="text-center mt-5 text-muted">
      &copy; <?= date("Y") ?> Traffic App - Developed by Camoy Phillips
    </footer>
  </div>

</body>
</html>
