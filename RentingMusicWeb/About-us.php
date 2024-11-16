<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Instrument Rent Service</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .about-section {
            background-color: #f8f9fa;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .center {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Instrument Rent Service</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="about-us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <a class="nav-link" href="admin.php">Admin</a>
                            <?php } else { ?>
                                <a class="nav-link" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- About Us Section -->
        <div class="about-section mt-5">
            <h1 class="center">About Us</h1>
            <!-- Responsive and Centered Image -->
            <img 
                src="img/store.png" 
                alt="store"
                class="d-block mx-auto my-4 img-fluid"
                style="max-width: 80%; height: auto; border-radius: 10px;"
            >
            <p>
                Welcome to <strong>Instrument Rent Service</strong>, your trusted partner for renting high-quality musical instruments. 
                Our mission is to make music accessible to everyone, whether you're a professional musician, a student, or simply someone who loves to play music.
            </p>
            <p>
                Established with the vision of supporting the music community, we offer a wide variety of musical instruments, including 
                guitars, pianos, violins, drums, and wind instruments. We cater to all levels of expertise, from beginners to seasoned professionals.
            </p>
            <p>
                Our rental plans are designed to be flexible and affordable, allowing you to explore your passion for music without breaking the bank. 
                Whether you need an instrument for a short-term event or long-term practice, we've got you covered.
            </p>
            <h3 class="mt-4">Why Choose Us?</h3>
            <ul>
                <li><strong>Wide Selection:</strong> Access a diverse collection of instruments across all categories.</li>
                <li><strong>Affordable Pricing:</strong> Flexible rental plans to suit every budget.</li>
                <li><strong>High-Quality Equipment:</strong> All instruments are well-maintained and tuned for optimal performance.</li>
                <li><strong>Customer Support:</strong> Our team is here to help you choose the right instrument and provide assistance when needed.</li>
            </ul>
            <p>
                At Instrument Rent Service, we believe in the power of music to bring people together and inspire creativity. 
                Join us in our journey to make music accessible to all. Let’s create harmony together!
            </p>
            <p class="text-center mt-4">
                <a href="contact-us.php" class="btn btn-primary">Get in Touch</a>
            </p>
        </div>
    </div>
</body>
</html>
