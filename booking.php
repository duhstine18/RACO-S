<?php
session_start();
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to book a car.'); window.location.href='login.php';</script>";
    exit;
}

// Get car_id from URL
$car_id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 0;

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $car_id = intval($_POST['car_id']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = "pending";

    // Validate date range
    if ($start_date >= $end_date) {
        echo "<script>alert('Invalid dates! End date must be after start date.'); window.location.href='booking.php?car_id=$car_id';</script>";
        exit;
    }

    // Check if car exists
    $check_car_query = "SELECT price_per_day FROM cars WHERE id = ?";
    $stmt = $conn->prepare($check_car_query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $car_result = $stmt->get_result();

    if ($car_result->num_rows == 0) {
        echo "<script>alert('Car not found.'); window.location.href='viewfleet.php';</script>";
        exit;
    }

    $car = $car_result->fetch_assoc();
    $price_per_day = $car['price_per_day'];

    // Check for overlapping bookings (pending or approved)
    $check_booking_query = "SELECT * FROM bookings 
        WHERE car_id = ? 
        AND status IN ('pending', 'approved')
        AND (
            (start_date BETWEEN ? AND ?) OR 
            (end_date BETWEEN ? AND ?) OR
            (? BETWEEN start_date AND end_date) OR
            (? BETWEEN start_date AND end_date)
        )";

    $stmt = $conn->prepare($check_booking_query);
    $stmt->bind_param("issssss", $car_id, $start_date, $end_date, $start_date, $end_date, $start_date, $end_date);
    $stmt->execute();
    $booking_result = $stmt->get_result();

    if ($booking_result->num_rows > 0) {
        echo "<script>alert('This car is already booked for the selected dates.'); window.location.href='booking.php?car_id=$car_id';</script>";
        exit;
    }

    // Calculate total price
    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    $total_price = max($days * $price_per_day, $price_per_day);

    // Insert the booking
    $sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, total_price, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissds", $user_id, $car_id, $start_date, $end_date, $total_price, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Booking request submitted! Waiting for admin approval.'); window.location.href='viewfleet.php';</script>";
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
    <meta charset="UTF-8">
    <title>Book a Car</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('image/mehmet-talha-onuk-aboFF2GXb_0-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .booking-container {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.2); /* More transparent */
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px); /* Optional: frosted glass effect */
            -webkit-backdrop-filter: blur(10px); /* Safari support */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Optional border */
        }

        .booking-container h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 24px;
            text-align: center;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #fff;
        }

        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Book a Car</h2>
        <form action="booking.php" method="POST">
            <label for="car_id">Car ID:</label>
            <input type="number" id="car_id" name="car_id" value="<?= htmlspecialchars($car_id) ?>" required readonly>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <input type="submit" value="Book Now">
        </form>
    </div>
</body>
</html>

