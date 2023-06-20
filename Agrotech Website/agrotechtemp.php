<?php
// Database configuration
$servername = "hostname"; // Enter your database server name
$dbname = "database"; // Enter your database name
$username = "username"; // Enter your database username
$password = "password"; // Enter your database password

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch sensor data
$sql = "SELECT id, value1, value2, value3, DATE_FORMAT(`reading_time`,'%a, %b %D, %h:%i:%s %p') as reading_time1 FROM Sensor order by reading_time desc";
$result = $conn->query($sql);

// Fetch sensor data into an array
$sensor_data = array();
while ($data = $result->fetch_assoc()){
    $sensor_data[] = $data;
}

// Extract readings time from sensor data
$readings_time = array_column($sensor_data, 'reading_time1');

// Query to calculate average, minimum, and maximum values
$sql = "SELECT ROUND(AVG(value2),2) as avg, MIN(value2) as min, MAX(value2) as max FROM Sensor";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result); 
$avg_value = $row['avg']; 
$min_value = $row['min']; 
$max_value = $row['max']; 

// Query to calculate average, minimum, and maximum values for the past 1 hour
$sql = "SELECT ROUND(AVG(value2),2) as avg_1, MIN(value2) as min_1, MAX(value2) as max_1 FROM Sensor WHERE reading_time > NOW() - INTERVAL 1 HOUR";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result); 
$avg_1 = $row['avg_1']; 
$min_1 = $row['min_1']; 
$max_1 = $row['max_1']; 

// Query to calculate average, minimum, and maximum values for the past 6 hours
$sql = "SELECT ROUND(AVG(value2),2) as avg_6, MIN(value2) as min_6, MAX(value2) as max_6 FROM Sensor WHERE reading_time > NOW() - INTERVAL 6 HOUR";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result); 
$avg_6 = $row['avg_6']; 
$min_6 = $row['min_6']; 
$max_6 = $row['max_6']; 

// Query to calculate average, minimum, and maximum values for the past 12 hours
$sql = "SELECT ROUND(AVG(value2),2) as avg_12, MIN(value2) as min_12, MAX(value2) as max_12 FROM Sensor WHERE reading_time > NOW() - INTERVAL 12 HOUR";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result); 
$avg_12 = $row['avg_12']; 
$min_12 = $row['min_12']; 
$max_12 = $row['max_12']; 

// Query to calculate average, minimum, and maximum values for the past 24 hours
$sql = "SELECT ROUND(AVG(value2),2) as avg_24, MIN(value2) as min_24, MAX(value2) as max_24 FROM Sensor WHERE reading_time > NOW() - INTERVAL 24 HOUR";

$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result); 
$avg_24 = $row['avg_24']; 
$min_24 = $row['min_24']; 
$max_24 = $row['max_24']; 

// ******* Uncomment to convert readings time array to your timezone ********
/*$i = 0;
foreach ($readings_time as $reading){
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 1 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
    $i += 1;
}*/

$sql_read = "SELECT value1 as temp, value2 as hum FROM Sensor order by reading_time desc limit 1";

$result = $conn->query($sql_read);
$row = mysqli_fetch_assoc($result); 
$temp = $row['temp']; 
$hum = $row['hum']; 

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

/*echo $value1;
echo $value2;
echo $value3;
echo $reading_time;*/

$result->free();
$conn->close();
?>

<!DOCTYPE html>
<html>
<title>Temperature</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <style>
  @import "https://code.highcharts.com/css/highcharts.css";
  @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    body {
    font-family: 'Montserrat', sans-serif;
    min-width: 310px;
    max-width: 1280px;
    height: 500px;
    margin: 0 auto;
    }
    h2 {
      text-align: center;
      font-size:  xx-large;
    }
    h3 {
      text-align: center;
      font-size:  large;
    }
       .header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
/* Define the stop colors */
#gradient-0 stop {
    stop-color: #7cb5ec;
}

#gradient-0 stop[offset="0"] {
    stop-opacity: 0.75;
}

#gradient-0 stop[offset="1"] {
    stop-opacity: 0;
}

#gradient-1 stop {
    stop-color: #5fa2d5;
}

#gradient-1 stop[offset="0"] {
    stop-opacity: 0;
}

#gradient-1 stop[offset="1"] {
    stop-opacity: 0.25;
}

/* Apply the gradients */
.highcharts-plot-background {
    fill: url(#gradient-1);
}

.highcharts-color-0 .highcharts-area {
    fill-opacity: 1;
    fill: url(#gradient-0);
}

.highcharts-background{
    fill: #FFFFFF;
}

.highcharts-axis-labels{
   fill: #333333;
}

.highcharts-title{
   fill: #333333;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  margin-top: 25px
}

th, td {
  text-align: center;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

  </style>
  <body>
 
<div class="header">
  <a href="#default" class="logo">AGROTECH</a>
  <div class="header-right">
    <a href="https://YOUR_URL/agrotech.php">Home</a>
    <a class="active"  href="https://YOUR_URL/agrotechtemp.php">Temperature</a>
    <a href="https://YOUR_URL/agrotechhum.php">Humidity</a>
  </div>
</div>


<div class="center bold bordered"> 
    <h2>AGROTECH</h3> 
   <h4>Temperature: <?php echo $temp; ?> &deg;C</h3>
  <h4>Humidity: <?php echo $hum; ?> %</h3>
</div>
    <div id="chart-temperature" class="container"></div>
    <div id="chart-humidity" class="container"></div>
    <div id="chart-pressure" class="container"></div>
    
<script>

var value1 = <?php echo $value1; ?>;
var value2 = <?php echo $value2; ?>;
var value3 = <?php echo $value3; ?>;
var reading_time = <?php echo $reading_time; ?>;



var chartT = new Highcharts.Chart({
  chart:{ 
     backgroundColor: '#FCFFC5',
     styledMode: true,
     borderRadius: 20,
     borderWidth: 2,
      renderTo : 'chart-temperature'
      },
  title: {
      text: 'BME280 Temperature'
      },
 defs: {
        gradient0: {
            tagName: 'linearGradient',
            id: 'gradient-0',
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1,
            children: [{
                tagName: 'stop',
                offset: 0
            }, {
                tagName: 'stop',
                offset: 1
            }]
        },
        gradient1: {
            tagName: 'linearGradient',
            id: 'gradient-1',
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1,
            children: [{
                tagName: 'stop',
                offset: 0
            }, {
                tagName: 'stop',
                offset: 1
            }]
        }
    },
  series: [{
    name: 'Temperature',
    type: 'area',
    showInLegend: false,
    data: value1
  }],
  plotOptions: {
    line: { animation: true,
      dataLabels: { enabled: true }
    }
  },
  xAxis: { 
    type: 'datetime',
    categories: reading_time
  },
  yAxis: {
    title: { text: 'Temperature (Celsius)' }
    //title: { text: 'Temperature (Fahrenheit)' }
  },
  credits: { enabled: false }
  
});



</script>

<div class="container">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Duration (Hours)</th>
          <th>Average (&deg;C)</th>
          <th>Maximun (&deg;C)</th>
          <th>Minimun (&deg;C)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">All</th>
          <td><?php echo $avg_value; ?></td>
          <td><?php echo $max_value; ?></td>
          <td><?php echo $min_value; ?></td>
        </tr>   
        <tr>
          <th scope="row">1</th>
          <td><?php echo $avg_1; ?></td>
          <td><?php echo $max_1; ?></td>
          <td><?php echo $min_1; ?></td>
        </tr>
        <tr>
          <th scope="row">6</th>
          <td><?php echo $avg_6; ?></td>
          <td><?php echo $max_6; ?></td>
          <td><?php echo $min_6; ?></td>
        </tr>
        <tr>
          <th scope="row">12</th>
          <td><?php echo $avg_12; ?></td>
          <td><?php echo $max_12; ?></td>
          <td><?php echo $min_12; ?></td>
        </tr>
         <tr>
          <th scope="row">24</th>
          <td><?php echo $avg_24; ?></td>
          <td><?php echo $max_24; ?></td>
          <td><?php echo $min_24; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>

