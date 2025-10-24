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
    <title>Contact Us - RACO'S</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background: url(image/contact-us.jpg) no-repeat center center/cover;
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

        .contact-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .contact-info img {
            max-width: 100px;
            display: block;
            margin: 0 auto 10px;
        }
        .map-container img {
            width: 100%;
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
        <h2>CONTACT US</h2>
        <p>Support You Can Count On.</p>
    </section>
    
    <section class="container my-5 d-flex flex-wrap">
        <div class="col-md-5 contact-info p-4">
            <img src="logo.png" alt="RACO'S Logo">
            <h3>RACO’S TRANSPORT</h3>
            <p><strong>📍 Address:</strong> Lion Kilat Street, Cebu City</p>
            <p><strong>📞 Phones:</strong><br>GLOBE: 0945-185-0200 / Landlines: 03-5124-8635<br>Corporate Accounts - Otero: 0927-534-8994</p>
            <p><strong>✉ Email:</strong> <a href="mailto:racorentalcar@gmail.com">racorentalcar@gmail.com</a></p>
        </div>
        <div class="col-md-7 p-4">
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Phone">
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <textarea class="form-control" id="question" rows="3" placeholder="Question"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">SEND</button>
            </form>
        </div>
    </section>
    
    <section class="container map-container my-5">
        <img src="map.png" alt="Map Location">
    </section>
    
    <footer>
        <p>&copy; 2025 RACO System | All rights reserved | Car Rental Website by RACOS.com</p>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
