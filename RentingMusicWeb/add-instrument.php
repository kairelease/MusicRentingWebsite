<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # category helper function
    include "php/func-category.php";
    $categories = get_all_category($conn);

    # owner helper function
    include "php/func-owner.php";
    $owner = get_all_owner($conn);

    if (isset($_GET['title'])) {
        $title = $_GET['title'];
    } else $title = '';

    if (isset($_GET['desc'])) {
        $desc = $_GET['desc'];
    } else $desc = '';

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
    } else $category_id = 0;

    if (isset($_GET['author_id'])) {
        $author_id = $_GET['author_id'];
    } else $author_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Instrument</title>

    <!--bootsrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--bootsrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Admin Page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="add-instrument.php">Add Instrument</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-category.php">Add Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-owner.php">Add Owner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-admin.php">Add Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex justify-content-center align-items-center vh-50">
        <form action="php/add-instrument.php" method="post" enctype="multipart/form-data" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;">
            <h1 class="text-center pb-5 display-4 fs-3">Add Instrument</h1>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" value="<?=$title?>" name="instrument_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" value="<?=$desc?>" name="instrument_desc">
            </div>
            <div class="mb-3">
                <label class="form-label">Instrument Owner</label>
                <select name="instrument_owner" class="form-control">
                    <option value="0">
                        Select Owner
                    </option>
                    <?php 
                    if ($owner == 0) {
                        //do nothing
                    } else {
                    
                    foreach ($owner as $eachOwner) { 
                        if ($owner_id == $eachOwner) {
                        ?>

                        <option selected value="<?=$eachOwner['id']?>">
                            <?=$eachOwner['name']?>
                        </option>
                    <?php } else { ?>
                        <option value="<?=$eachOwner['id']?>">
                            <?=$eachOwner['name']?>
                        </option>
                    <?php } } } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="instrument_category" class="form-control">
                    <option value="0">
                        Select Category
                    </option>
                    <?php 
                    if ($categories == 0) {
                        //do nothing
                    } else {
                    foreach ($categories as $category) { 
                        if ($category_id == $category) {
                        ?>

                        <option selected value="<?=$category['id']?>">
                            <?=$category['name']?>
                        </option>
                    <?php } else { ?>
                        <option value="<?=$category['id']?>">
                            <?=$category['name']?>
                        </option>
                    <?php } } } ?>
                </select>

            </div>
            <div class="mb-3">
                <label class="form-label">Cover</label>
                <input type="file" class="form-control" name="instrument_cover">
            </div>
            <div class="mb-3">
                <label class="form-label">File</label>
                <input type="file" class="form-control" name="file">
            </div>

            <button type="submit" class="btn btn-primary">Add Instrument</button>
        </form>
        </div>
    </div>
</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>