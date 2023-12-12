<?php
// Include your database connection logic here

// Fetch car data from the database
// Replace the following with your actual database query
$cars = [
    ['car_id' => 1, 'brand' => 'Toyota', 'model' => 'Camry'],
    ['car_id' => 2, 'brand' => 'Honda', 'model' => 'Civic'],
    ['car_id' => 3, 'brand' => 'Ford', 'model' => 'F-150'],
];

// Return car data as JSON
header('Content-Type: application/json');
echo json_encode($cars);
?>
