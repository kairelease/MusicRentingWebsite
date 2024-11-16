<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitForm'])) {
    // Process form data (e.g., save to database, send email, etc.)
    
    // Redirect back with a success message
    header("Location: contact-us.php?success=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Store Rent</title>

    <!--bootsrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--bootsrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
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
                            <a class="nav-link" href="about-us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact-us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <a class="nav-link" href="admin.php">Admin</a>
                            <?php } else {?>
                                <a class="nav-link" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <main>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%;" method="POST" action="">
                <h1 class="text-center display-4 pb-5">Contact Us!</h1>

                <!-- Success Alert -->
                <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
                    <div class="alert alert-success" role="alert">
                        Your message has been successfully sent!
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Spongebob Squarepants" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Your e-mail</label>
                    <input type="email" name="mail" class="form-control" placeholder="youremail@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="What's your topic?" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" class="form-control" placeholder="Write your reasoning..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submitForm">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>