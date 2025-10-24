<?php
session_start();
include('db.php');

// Fetch all available cars
$sql = "SELECT * FROM cars WHERE status = 'available'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Available Cars</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
</head>
<body>
    <h2>Available Cars</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price per Day</th>
            <th>Action</th>
        </tr>
        <?php while ($car = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $car['id'] ?></td>
                <td><?= htmlspecialchars($car['brand']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
                <td><?= $car['year'] ?></td>
                <td>₱<?= number_format($car['price_per_day'], 2) ?></td>
                <td>
                    <a href="booking.php?car_id=<?= $car['id'] ?>" class="btn btn-primary">Book Now</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
