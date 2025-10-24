<?php
session_start();
include('db.php'); // Database connection

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

// Check if the form is submitted to confirm a booking
if (isset($_POST['confirm_booking'])) {
    $booking_id = $_POST['booking_id'];
    $car_id = $_POST['car_id'];

    // Debugging: print booking_id and car_id (optional, remove in production)
    // var_dump($booking_id, $car_id);
    // exit();

    // Update booking status to confirmed
    $update_booking = "UPDATE bookings SET status = 'confirmed' WHERE id = ?";
    $stmt = $conn->prepare($update_booking);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    // Update car status to rented
    $update_car = "UPDATE cars SET status = 'rented' WHERE id = ?";
    $stmt = $conn->prepare($update_car);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();

    // Redirect or display success message
    header("Location: admin_dashboard.php?.");
    exit();
}

// Fetch bookings from the database
$bookings_query = "SELECT * FROM bookings";
$bookings_result = $conn->query($bookings_query);

// Fetch cars from the database
$cars_query = "SELECT * FROM cars";
$cars_result = $conn->query($cars_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin: 5px 0;
            text-align: center;
            font-size: 18px;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }
        h2 {
            text-align: center;
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="#bookings">Bookings</a>
        <a href="#cars">Cars</a>
        <a href="#add_car">Add Car</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h2>Admin Dashboard</h2>
        
        <?php if (isset($_GET['message'])): ?>
            <div style="color: green; text-align: center;">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <h3 id="bookings">Bookings</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Car ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php if ($bookings_result->num_rows > 0) {
                while ($booking = $bookings_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['user_id'] ?></td>
                        <td><?= $booking['car_id'] ?></td>
                        <td><?= $booking['start_date'] ?></td>
                        <td><?= $booking['end_date'] ?></td>
                        <td><?= $booking['total_price'] ?></td>
                        <td><?= $booking['status'] ?></td>
                        <td>
                            <?php if ($booking['status'] === 'pending'): ?>
                                <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                    <input type="hidden" name="car_id" value="<?= $booking['car_id'] ?>">
                                    <button type="submit" name="confirm_booking">Confirm</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="8">No bookings found.</td>
                </tr>
            <?php } ?>
        </table>
        
        <h3 id="cars">Cars</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price per Day</th>
                <th>Status</th>
            </tr>
            <?php if ($cars_result->num_rows > 0) {
                while ($car = $cars_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $car['id'] ?></td>
                        <td><?= $car['brand'] ?></td>
                        <td><?= $car['model'] ?></td>
                        <td><?= $car['year'] ?></td>
                        <td><?= $car['price_per_day'] ?></td>
                        <td><?= $car['status'] ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">No cars found.</td>
                </tr>
            <?php } ?>
        </table>
        
        <h3 id="add_car">Add New Car</h3>
        <form action="add_car.php" method="POST">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
            
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>
            
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>
            
            <label for="price_per_day">Price per Day:</label>
            <input type="number" id="price_per_day" name="price_per_day" required>
            
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="available">Available</option>
                <option value="rented">Rented</option>
            </select>
            
            <input type="submit" value="Add Car">
        </form>
    </div>
</body>
</html>
