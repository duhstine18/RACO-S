<?php
include('db.php');

// Update cars that have passed the booking end date
$sql = "UPDATE cars 
        SET status = 'available' 
        WHERE id IN (SELECT car_id FROM bookings WHERE end_date < CURDATE() AND status = 'pending')";

if ($conn->query($sql) === TRUE) {
    echo "Car statuses updated successfully!";
} else {
    echo "Error updating statuses: " . $conn->error;
}

$conn->close();
?>
