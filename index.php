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
            background: url(image/dean-huber-L8-4xHsNzMA-unsplash.jpg) no-repeat center center/cover;
            height: 800px;
            color: rgb(0, 0, 0);
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
                    <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="viewfleet.php" class="nav-link text-white">Fleet</a></li>
                    <li class="nav-item"><a href="aboutus.php" class="nav-link text-white">About Us</a></li>
                    <li class="nav-item"><a href="contactus.php" class="nav-link text-white">Contact Us</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero text-center d-flex flex-column justify-content-center align-items-center">
        <h2>RENT A CAR ONLINE SYSTEM</h2>
        <div class="mt-3">
            <a href="login.php" class="btn btn-outline-light">Log In</a>
            <a href="signup.php" class="btn btn-dark">Sign Up</a>
        </div>
    </section>

    <div class="modal" id="authModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authTitle">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="authForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="authButton">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="container text-center my-5" id="carSection" style="display: none;">
        <div class="row">
            <div class="col-md-4">
                <img src="image/civic2.jpg" class="img-fluid" alt="Group A">
                <h4>Group A</h4>
                <p>Price from: ₱ 1,750</p>
                <button class="btn btn-primary">BOOK NOW</button>
            </div>
            <div class="col-md-4">
                <img src="image/grandia.jpg" class="img-fluid" alt="Group B">
                <h4>Group B</h4>
                <p>Price from: ₱ 4,100</p>
                <button class="btn btn-primary">BOOK NOW</button>
            </div>
            <div class="col-md-4">
                <img src="image/fortuner.jpg" class="img-fluid" alt="Group C">
                <h4>Group C</h4>
                <p>Price from: ₱ 3,550</p>
                <button class="btn btn-primary">BOOK NOW</button>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Raco System | All rights reserved | Car Rental Website by RACOS.com</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
       
        window.onload = function() {
            if (localStorage.getItem("isLoggedIn") === "true") {
                showCarSection();
            }
        };

     
        function showCarSection() {
            document.getElementById("carSection").style.display = "block";
        }

        
        function showLogin() {
            document.getElementById('authTitle').textContent = 'Login';
            document.getElementById('authButton').textContent = 'Login';
            var authModal = new bootstrap.Modal(document.getElementById('authModal'));
            authModal.show();

            document.getElementById("authForm").onsubmit = function(event) {
                event.preventDefault();
               
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                
                if (email === "test@example.com" && password === "password123") {
                    localStorage.setItem("isLoggedIn", "true");
                    showCarSection();
                    var authModal = bootstrap.Modal.getInstance(document.getElementById('authModal'));
                    authModal.hide();
                } else {
                    alert("Invalid login credentials!");
                }
            };
        }

       
        function showSignUp() {
            document.getElementById('authTitle').textContent = 'Sign Up';
            document.getElementById('authButton').textContent = 'Sign Up';
            var authModal = new bootstrap.Modal(document.getElementById('authModal'));
            authModal.show();
        }
    </script>
</body>
</html>
