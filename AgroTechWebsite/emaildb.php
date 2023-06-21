<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize the variables
    $email_input = $_POST['email_input'];
    $thresholdtemp_aboveinput = $_POST['thresholdtemp_aboveinput'];
    $thresholdtemp_belowinput = $_POST['thresholdtemp_belowinput'];
    $thresholdhum_aboveinput = $_POST['thresholdhum_aboveinput'];
    $thresholdhum_belowinput = $_POST['thresholdhum_belowinput'];

    // Connect to the database
    $db_host = "hostname"; // Enter the database host
    $db_username = "username"; // Enter the database username
    $db_password = "password"; // Enter the database password
    $db_name = "database"; // Enter the database name

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into the table
    $query = "INSERT INTO EmailData (email, thresholdtemp_above, thresholdtemp_below, thresholdhum_above, thresholdhum_below)
              VALUES ('$email_input', '$thresholdtemp_aboveinput', '$thresholdtemp_belowinput', '$thresholdhum_aboveinput', '$thresholdhum_belowinput')";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("New record created successfully\n")       
        window.location.replace("home.php");
        </script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
