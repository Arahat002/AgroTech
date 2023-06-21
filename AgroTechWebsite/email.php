<?php 
$db_host = "hostname"; // Enter the database host
$db_username = "username"; // Enter the database username
$db_password = "password"; // Enter the database password
$db_name = "database"; // Enter the database name

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// SQL query for retrieving values from Sensor and EmailData tables
$sql1 = "SELECT EmailData.thresholdtemp_above, EmailData.thresholdtemp_below, EmailData.thresholdhum_above, EmailData.thresholdhum_below, Sensor.value1 AS temp, Sensor.value2 AS hum, DATE_FORMAT(Sensor.reading_time,'%a, %b %D, %h:%i:%s %p') AS reading_time1, EmailData.email AS email, EmailData.sent_time as sent_time 
FROM Sensor JOIN EmailData 
ON Sensor.value1 BETWEEN EmailData.thresholdtemp_above AND EmailData.thresholdtemp_below OR Sensor.value2 BETWEEN EmailData.thresholdhum_above AND EmailData.thresholdhum_below 
ORDER BY Sensor.reading_time DESC LIMIT 1";

$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

// Get the temperature and humidity values from the Sensor table
$temp = $row1['temp'];
$hum = $row1['hum'];
$reading_time1 = $row1['reading_time1'];

// Get the email from the EmailData table
$email = $row1['email'];

// Get the sent_time from the EmailData table
$sent_time = $row1['sent_time'];

// Get the threshold temperature and humidity values from the EmailData table
$thresholdtemp_above = $row1['thresholdtemp_above'];
$thresholdtemp_below = $row1['thresholdtemp_below'];
$thresholdhum_above = $row1['thresholdhum_above'];
$thresholdhum_below = $row1['thresholdhum_below'];

// Check if an email has already been sent
if ($sent_time != $reading_time1) {

    // Check if the temperature or humidity values are above or below the threshold values
    if ($temp > $thresholdtemp_above || $temp < $thresholdtemp_below || $hum > $thresholdhum_above || $hum < $thresholdhum_below) {
        
        // Send email
        $to = $email;
        $subject = "Threshold temperature/humidity value is above/below";
        $message = "The temperature is $temp and the humidity is $hum. The threshold temperature is between $thresholdtemp_below and $thresholdtemp_above OR the threshold humidity is between $thresholdhum_below and $thresholdhum_above on $reading_time1.";
        $headers = "From: username@example.com";
        mail($to, $subject, $message, $headers);

        // Update the sent_time in the EmailData table
        $query = "UPDATE EmailData SET sent_time = '$reading_time1' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        echo "Email sent to $email";
    }
} else {
    echo "No need to send email";
}

mysqli_close($conn);
