<?php
$db_host = "hostname"; // Enter the database host
$db_username = "username"; // Enter the database username
$db_password = "password"; // Enter the database password
$db_name = "database"; // Enter the database name

$db_connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$id = $_GET['id'];

$query = "DELETE FROM EmailData WHERE id='$id'";

if (mysqli_query($db_connect, $query)) {
  echo '<script>alert("Deleted data successfully\n")
  window.location.replace("home.php");
  </script>';
} else {
  echo "ERROR: Could not execute $query. " . mysqli_error($db_connect);
}

// Reset the auto-increment value
$setNum = "SET @num = 0";
if (mysqli_query($db_connect, $setNum)) {
  echo '<script>alert("Auto Increment value reset successfully\n")
  window.location.replace("home.php");
  </script>';
} else {
  echo "ERROR: Could not execute $setNum. " . mysqli_error($db_connect);
}

// Update the ids in EmailData table
$setId = "UPDATE EmailData SET id = @num := (@num+1)";
if (mysqli_query($db_connect, $setId)) {
  echo '<script>alert("IDs updated successfully\n")
  window.location.replace("home.php");
  </script>';
} else {
  echo "ERROR: Could not execute $setId. " . mysqli_error($db_connect);
}

// Reset the auto-increment value to 1
$resetAutoIncrement = "ALTER TABLE EmailData AUTO_INCREMENT = 1";
if (mysqli_query($db_connect, $resetAutoIncrement)) {
  echo '<script>alert("Auto Increment value reset successfully\n")
  window.location.replace("home.php");
  </script>';
} else {
  echo "ERROR: Could not execute $resetAutoIncrement. " . mysqli_error($db_connect);
}

mysqli_close($db_connect);
