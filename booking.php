<?php
session_start();
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to book a car.'); window.location.href='login.php';</script>";
    exit;
}

// Get car_id from URL if available
$car_id = isset($_GET['car_id']) ? $_GET['car_id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $car_id = $_POST['car_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = "pending";

    // Validate dates
    if ($start_date >= $end_date) {
        echo "<script>alert('Invalid dates! End date must be after start date.'); window.location.href='booking.php?car_id=$car_id';</script>";
        exit;
    }

    // Check if car exists in database and get price_per_day
    $check_car_query = "SELECT price_per_day, status FROM cars WHERE id = ? AND status = 'available'";
    $stmt = $conn->prepare($check_car_query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $car_result = $stmt->get_result();
    
    if ($car_result->num_rows == 0) {
        echo "<script>alert('Car is not available for booking.'); window.location.href='index.php';</script>";
        exit;
    }

    $car = $car_result->fetch_assoc();
    $price_per_day = $car['price_per_day'];

    // Check if car is already booked in the selected dates
    $check_booking_query = "SELECT * FROM bookings WHERE car_id = ? AND ((start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?))";
    $stmt = $conn->prepare($check_booking_query);
    $stmt->bind_param("issss", $car_id, $start_date, $end_date, $start_date, $end_date);
    $stmt->execute();
    $booking_result = $stmt->get_result();

    if ($booking_result->num_rows > 0) {
        echo "<script>alert('This car is already booked for the selected dates. Please choose another date.'); window.location.href='booking.php?car_id=$car_id';</script>";
        exit;
    }

    // Calculate total price
    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    $total_price = max($days * $price_per_day, $price_per_day); // Ensure at least 1 day charge

    // Insert booking into database with total_price
    $sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, total_price, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissds", $user_id, $car_id, $start_date, $end_date, $total_price, $status);

    if ($stmt->execute()) {
        // Update car status to 'rented' after a successful booking
        $update_car_status_query = "UPDATE cars SET status = 'rented' WHERE id = ?";
        $stmt = $conn->prepare($update_car_status_query);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();

        echo "<script>alert('Booking successful! Total price: ₱" . number_format($total_price, 2) . "'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Booking failed: " . $stmt->error . "'); window.location.href='booking.php?car_id=$car_id';</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book a Car</title>
</head>
<body>
    <h2>Book a Car</h2>
    <form action="booking.php" method="POST">
        <label for="car_id">Car ID:</label>
        <input type="number" id="car_id" name="car_id" value="<?= htmlspecialchars($car_id) ?>" required readonly><br><br>
        
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        
        <input type="submit" value="Book Now">
    </form>
</body>
</html>
