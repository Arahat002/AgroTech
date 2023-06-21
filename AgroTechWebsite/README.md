# AgroTech: Web App

AgroTech is a web application that displays temperature and humidity data from sensors in an agricultural setting. It also allows users to add their email address and set threshold values for temperature and humidity, triggering notifications when the readings go beyond the specified thresholds.

## Repository Structure
The repository has the following files:

1. `agrotech.php`: Home page that provides an overview of AgroTech and its functionalities.

2. `agrotechtemp.php`: Retrieve temperature data from the Sensor table in the database and display it in a web interface. These pages also calculate and display statistics for the sensor data over different time periods.

3. `agrotechhum.php`: Retrieve humidity data from the Sensor table in the database and display it in a web interface. These pages also calculate and display statistics for the sensor data over different time periods.

4. `api.php`: Retrieve temperature and humidity data from the Sensor table in the database and return the data in JSON format.

5. `data.php`: Receive temperature and humidity data from an external device, validate it, and store it in the Sensor table of the database.

6. `delete.php`: Delete a record from the EmailData table in the database based on the provided ID. It also resets the auto-increment value and updates the ID column in the EmailData table.

7. `email.php`: Check the latest temperature and humidity values against the threshold values in the EmailData table. If the values exceed the thresholds, an email is sent.

8. `emaildb.php`: Handle the addition of data to the EmailData table in the database. It receives data through an HTTP POST request and inserts it into the table.

## Installation

1. Clone the repository: `git clone https://github.com/Arahat002/AgroTech.git`
2. Set up a web server with PHP support.
3. Create a MySQL database and import the provided SQL file.
4. Update the database connection credentials in the PHP files (`agrotech.php`, `emaildb.php`).
5. Open `agrotech.php` in a web browser to access the AgroTech dashboard.

## Usage

- The homepage (`agrotech.php`) displays the current temperature and humidity readings.
- Click on the "Temperature" and "Humidity" links in the header to view historical data.
- Click on the "Add Email" button to open a modal for adding an email address and threshold values.
- Fill in the required fields in the modal and click "Submit" to add the email address and thresholds to the database.
- Notifications will be sent when the temperature or humidity readings exceed the specified thresholds.
- Upon accessing the application, you will see a table displaying the sensor data retrieved from the database.
- Below the table, you will find statistics for the overall sensor data and different time periods (1 hour, 6 hours, 12 hours, and 24 hours). These statistics include the average, minimum, and maximum values of the sensor data.
- The sensor data and statistics are automatically updated each time you access the application.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [Apache License 2.0](LICENSE).