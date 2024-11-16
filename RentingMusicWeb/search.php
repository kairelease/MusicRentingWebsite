<?php
session_start();
# if search key is not set or empty
if (!isset($_GET['key']) || empty($_GET['key'])) {
    header("Location: index.php");
    exit;
}

$key = $_GET['key'];

#database connection file
include "db_conn.php";

# instrument helper function
include "php/func-instrument.php";
$instrument = search_instrument($conn, $key);

# owner helper function
include "php/func-owner.php";
$owner = get_all_owner($conn);

# category helper function
include "php/func-category.php";
$categories = get_all_category($conn);

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
  </body>
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="About-us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.php">Contact Us</a>
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
        </nav><br>
        Search result for <b><?=$key?></b>

        <div class="d-flex pt-3">
            <?php if ($instrument == 0) { ?>
                <div class="alert alert-warning text-center p-5 pdf-list" role="alert">
                    <img src="img/no-search-result.png" width="80"> <br>
                    The key <b>"<?=$key?>"</b> didn't match any records
		        </div>
            <?php } else { ?>
            <div class="pdf-list d-flex flex-wrap">
                <?php foreach ($instrument as $eachInstrument) { ?>
                <div class="card m-1">
                    <img src="uploads/cover/<?=$eachInstrument['cover']?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?=$eachInstrument['title']?></h5>
                        <p class="card-text">

                            <i><b>
                                <?php foreach ($categories as $category) { 
                                    if ($category['id'] == $eachInstrument['category_id']) {
                                        echo $category['name'];
                                        break;
                                    }
                                    ?>

                            <?php } ?>
                            <br><br></b></i>

                            <?=$eachInstrument['description']?> <br>

                            <b>
                                Owner: <br><?php foreach ($owner as $eachOwner) { 
                                    if ($eachOwner['id'] == $eachInstrument['owner_id']) {
                                        echo $eachOwner['name'];
                                        break;
                                    }
                                    ?>

                            <?php } ?>
                            <br></b>
                        </p>
                        <a href="uploads/files/<?=$eachInstrument['file']?>" class="btn btn-success">View</a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>