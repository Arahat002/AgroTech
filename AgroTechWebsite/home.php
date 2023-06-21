<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
  body {
    font-family: 'Montserrat', sans-serif;
    padding: 20px;
    background-color: #fafafa;
  }
  
  .center {
    text-align: center;
    font-size: 1.2rem;
    font-weight: 500;
  }

  .bold {
    font-weight: bold;
    font-size: 1.2rem;
    font-weight: 500;
  }

  .bord {
    padding: 10px;
    border-radius: 8px;
  }

  h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  h3 {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  table {
    border: 1px solid #ccc;
    margin: 0;
    border-collapse: collapse;
    padding: 0;
    width: 100%;
    table-layout: fixed;
  }

  table caption {
    font-size: 1.5em;
    margin: .5em 0 .75em;
  }

  table tr {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: .35em;
  }

  table th,
  table td {
    padding: .625em;
    text-align: center;
  }

  table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2
  }

  a:link {
    color: #7cb5ec;
    background-color: transparent;
    text-decoration: none;
   }
   a:visited {
    color: #7cb5ec;
    background-color: transparent;
    text-decoration: none;
   }
  a:hover {
     color: blue;
     background-color: transparent;
     text-decoration: underline;
   }
  @media screen and (max-width: 600px) {
    table {
      border: 0;
    }

    table caption {
      font-size: 1.3em;
    }

    table thead {
      border: none;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
    }

    table tr {
      border-bottom: 3px solid #ddd;
      display: block;
      margin-bottom: .625em;
    }

    table td {
      border-bottom: 1px solid #ddd;
      display: block;
      font-size: .8em;
      text-align: right;
    }

    table td::before {
      content: attr(data-label);
      float: left;
      font-weight: bold;
      text-transform: uppercase;
    }

    table td:last-child {
      border-bottom: 0;
    }
  }

  /* Modal Styling */
  .modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    transform: scale(1.1);
    transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
    -webkit-transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
  }

  .modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
  }

  /* Utility classes for showing and hiding modal */
  .show-modal {
    opacity: 1;
    visibility: visible;
    transform: scale(1.0);
    transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    -webkit-transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
  }

  /* Button */
  .btn {
    background-color: #7cb5ec;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    margin-bottom: 10px;
    -webkit-border-radius: 4px;
  }

  /* Button Hover */
  .btn:hover {
    background-color: #7cb5ec;
  }

  /* Close Button */
  .close {
    float: right;
    width: 20px;
    line-height: 20px;
    text-align: center;
    border-radius: 50%;
    background-color: #aaa;
    color: #fff;
    font-family: Arial, sans-serif;
    font-size: 24px;
    cursor: pointer;
  }

  /* Close Button Hover */
  .close:hover {
    background-color: #7cb5ec;
  }

  /* Form Styling */
  label {
    display: flex;
    line-height: 26px;
    margin-bottom: 10px;
  }

  input[type="text"],
  input[type="number"],
  input[type="email"] {
    padding: 12px;
    width: 100%;
    border: 1px solid #ccc;
    box-sizing: border-box;
    margin-bottom: 8px;
    font-size: 14px;
    border-radius: 4px;
  }

  button[type="submit"] {
    background-color: #7cb5ec;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #7cb5ec;
  }

  input[type="checkbox"] {
    margin-right: 5px;
    margin-bottom: 16px;
  }

  input[type="checkbox"],
  input[type="radio"] {

  }
  </style>
</head> 
<body> 

<?php 
// PHP code for database connection and fetching data
$db_host="";  // Database host
$db_username="";  // Database username
$db_password="";  // Database password
$db_name="";  // Database name

$db_connect=mysqli_connect($db_host,$db_username,$db_password,$db_name);  // Connect to the database
$sql="SELECT * FROM EmailData";  // SQL query to select data from "EmailData" table
$result=mysqli_query($db_connect,$sql);  // Execute the query and get the result

$sql1 = "SELECT value1 as temp, value2 as hum FROM Sensor order by reading_time desc limit 1";  // SQL query to select temperature and humidity data from "Sensor" table
$result1=mysqli_query($db_connect,$sql1);  // Execute the query and get the result
$row = mysqli_fetch_assoc($result1);  // Fetch the row from the result
$temp = $row['temp'];  // Get the temperature value
$hum = $row['hum'];  // Get the humidity value

?> 



<div class="center bold bordered"> 
    <h2>AGROTECH</h3> 
   <h4>Temperature: <?php echo $temp; ?> &deg;C</h3>
  <h4>Humidity: <?php echo $hum; ?> %</h3>
</div>
<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn btn-primary">Add Email</button>

<!-- The Modal -->
<div id="myModal" class="modal" style="display: none;">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form name="contact_form" action="emaildb.php" method="POST" class="row g-4">
      <label for="email_input">Email Address</label>
      <input type="email" name="email_input" value="" required><br>
      <label for="thresholdtemp_aboveinput">Temperature Above</label>
      <input type="number" step="0.1" name="thresholdtemp_aboveinput" value="" required><br>
      <label for="thresholdhum_belowinput">Temperature Below</label>
      <input type="number" step="1" name="thresholdtemp_belowinput" value="" required><br>
      <label for="thresholdhum_aboveinput">Humidity Above</label>
      <input type="number" step="1" name="thresholdhum_aboveinput" value="" required><br>
      <label for="thresholdhum_belowinput">Humidity Below</label>
      <input type="number" step="1" name="thresholdhum_belowinput" value="" required><br>
     <button type="submit" onclick="alert('Submitting')">Submit</button>
    </form>
  </div>

</div>

  <script>
  // Get the modal
  var modal = document.getElementsByClassName("modal")[0];

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  </script>

<div class="bordered"> 
    <table class="center" cellpadding="5" cellspacing="5"> 
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Email</th>
      <th scope="col">Temperature Above</th>
      <th scope="col">Temperature Below</th>
      <th scope="col">Humidity Above</th>
      <th scope="col">Humidity Below</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    while($row=mysqli_fetch_assoc($result)){ 
        ?> 
    <tr>
      <td data-label="Id"><?php echo $row["id"];?></td>
      <td data-label="Email"><?php echo $row["email"];?></td>
      <td data-label="Temperature Above"><?php echo $row["thresholdtemp_above"];?></td>
      <td data-label="Temperature Below"><?php echo $row["thresholdtemp_below"];?></td>
      <td data-label="Humidity Above"><?php echo $row["thresholdhum_above"];?></td>
      <td data-label="Humidity Below"><?php echo $row["thresholdhum_below"];?></td>

      <td data-label="Delete"><a href="delete.php?id=<?php echo $row["id"];?>">Delete</a></td>
    </tr>
        <?php 
    } 
    ?> 
    </tbody>
    </table> 
</div> 



    

</body> 
</html>