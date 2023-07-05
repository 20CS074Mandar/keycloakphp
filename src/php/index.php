<?php
require_once 'auth.php';
authorize();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Service PHP APP</title>
</head>
<body>
  <button onclick="logout()" class="btn btn-danger">Logout</button>
  <h1>index</h1>
  <a href="home.php">Home</a>
  <a href="dashboard.php">dash</a>
  <a href="profile.php">profile</a>
  <a href="index.php">index</a>

</body>
</html>
