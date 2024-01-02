<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//below two statements will stop sending errors on the client request/ ajax request 
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);

//change here dont use the variables for database connection which is used elsewhere for make connection

//the admin login here is working cause i when tried to login this page without skip-grant-tables in mysql.ini file then the localhost refused to connect and said you dont have the right to connect to admin. so just integrate the user and admin login in this.

// require 'db_connection.php';

require_once 'model/db.php';

// $database = new Database();
// $conn = $database->conn;

//below both methods are not working 
// require '../db.php'; // check how can db_connection.php be required from another folder
// require_once __DIR__ . '/api/inclino/modal/db_connection.php';


// Handle GET request to insert data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the keys exist in the $_GET array before accessing them
    $deviceNumber = isset($_GET['device_number']) ? $_GET['device_number'] : null;
    $sensor = isset($_GET['sensor']) ? $_GET['sensor'] : null;
    $value1 = isset($_GET['value1']) ? $_GET['value1'] : null;
    $value2 = isset($_GET['value2']) ? $_GET['value2'] : null;

    // Only attempt to insert data if all parameters are present
    if ($deviceNumber && $sensor && $value1 && $value2) {
        // Insert data into the 'inclino_device_data' table
        $sqlInsert = "INSERT INTO inclino_device_data (device_number, sensor, value1, value2, date_time) VALUES ('$deviceNumber', '$sensor', '$value1', '$value2','" . date('Y-m-d H:i:s') . "')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }
}

// Fetch data from the 'inclino_device_data' table
$sqlSelect = "SELECT * FROM inclino_device_data";
$result = $conn->query($sqlSelect);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Wrap the data array in an object with a "data" key
$response = array('data' => $data);

// Close the database connection
$conn->close();
// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($response);

exit();
