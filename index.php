<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACO'S - Rent A Car Online System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background: url('hero-image.jpg') no-repeat center center/cover;
            height: 400px;
            color: white;
        }
        .hero h2 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .hero button {
            margin: 5px;
        }
        .container img {
            max-width: 100%;
            height: auto;
        }
        .card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }
        footer {
            background: #222;
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
                    <li class="nav-item"><a href="#" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white" id="viewFleet">Fleet</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">About Us</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero text-center d-flex flex-column justify-content-center align-items-center">
        <h2>RENT A CAR ONLINE SYSTEM</h2>
        <div class="mt-3">
            <!-- Link to the login and sign-up pages -->
            <a href="login.php" class="btn btn-outline-light">Log In</a>
            <a href="signup.php" class="btn btn-dark">Sign Up</a>
        </div>
    </section>

    <section class="container text-center my-5">
        <div class="row">
            <div class="col-md-4">
                <img src="mirage1.png" class="img-fluid" alt="Group A">
                <h4>Group A</h4>
                <p>Price from: ₱ 1,500</p>
                <a href="booking.php?car_id=1" class="btn btn-primary">BOOK NOW</a>
            </div>

            <div class="col-md-4">
                <img src="civic2.png" class="img-fluid" alt="Group B">
                <h4>Group B</h4>
                <p>Price from: ₱ 1,750</p>
                <a href="booking.php?car_id=2" class="btn btn-primary">BOOK NOW</a>
            </div>

            <div class="col-md-4">
                <img src="vios3.png" class="img-fluid" alt="Group C">
                <h4>Group C</h4>
                <p>Price from: ₱ 1,950</p>
                <a href="booking.php?car_id=3" class="btn btn-primary">BOOK NOW</a>
            </div>
        </div>
    </section>

    <section class="bg-light py-5 text-center">
        <h3>Customer Reviews</h3>
        <div class="container d-flex justify-content-center">
            <div class="card mx-2 p-3">
                <p><strong>Alice Smith</strong> ⭐⭐⭐⭐⭐</p>
                <p>Great service and amazing cars!</p>
            </div>
            <div class="card mx-2 p-3">
                <p><strong>Bob Johnson</strong> ⭐⭐⭐⭐⭐</p>
                <p>Smooth booking process and friendly staff.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Raco System | All rights reserved | Car Rental Website by RACOS.com</p