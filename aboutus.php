<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - RACO'S</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background: url(image/about-us.jpg) no-repeat center center/cover;
            height: 300px;
            color: rgb(0, 0, 0);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hero h2 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .container img {
            width: 100%;
            max-width: 600px;
            height: auto;
            display: block;
            margin: 20px auto;
            border-radius: 10px;
        }
        footer {
            background:  #222;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>RACO'S</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="viewfleet.php" class="nav-link text-white">Fleet</a></li>
                    <li class="nav-item"><a href="aboutus.php" class="nav-link text-white">About Us</a></li>
                    <li class="nav-item"><a href="contactus.php" class="nav-link text-white">Contact Us</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <h2>ABOUT US</h2>
        <p>Rent. Drive. Explore. Repeat.</p>
    </section>
    
    <section class="container my-5 text-center">
        <img src="image/yellow van.jpg" alt="Scenic Drive">
        <p>In RACO System, we aim to be the leading Car Rental Company offering brand new cars for rent in the most affordable prices in the market.</p>
    </section>
    
    <section class="container my-5 d-flex flex-wrap align-items-center">
        <img src="image/happy driver.jpg" class="col-md-6" alt="Happy Driver">
        <div class="col-md-6">
            <p>Enjoy one-of-a-kind car rental service including transfer services, car hire, self-driven, bridal services, long and short-term leases and more.</p>
        </div>
    </section>
    
    <section class="container my-5 d-flex flex-wrap align-items-center">
        <div class="col-md-6">
            <p>With its sound experience and understanding of customers’ needs, RACO System is committed to offering the best one-stop personal service.</p>
        </div>
        <img src="image/key.jpg " class="col-md-6" alt="Car Handover">
    </section>
    
    <footer>
        <p>&copy; 2025 RACO System | All rights reserved | Car Rental Website by RACOS.com</p>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
