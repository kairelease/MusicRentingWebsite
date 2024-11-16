<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    #database connection file
    include "db_conn.php";

    # instrument helper function
    include "php/func-instrument.php";
    $instrument = get_all_instrument($conn);

    # owner helper function
    include "php/func-owner.php";
    $owner = get_all_owner($conn);

    # category helper function
    include "php/func-category.php";
    $categories = get_all_category($conn);

    //print_r($instrument); for test
    //print_r($owner);
    //print_r($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

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
                            <a class="nav-link" href="add-instrument.php">Add Instrument</a>
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

        <form action="search.php" method="get" style="width: 100%; max-width: 30rem;">
            <div class="input-group my-5">
                <input type="text" class="form-control" name="key" placeholder="Search Instrument..." aria-label="Search Instrument..." aria-describedby="basic-addon2">
                <button class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
            </div>
        </form>

        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>

		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>

        <?php if ($instrument ==0) { ?>
            <div class="alert alert-warning text-center p-5" role="alert">
                <img src="img/empty.png" width="80"> <br>
                There isn't any Musical Instrument in the database
		    </div>
        <?php } else { ?>
            <!-- list all instrument-->
        <h4 class="mt-5">All Instrument</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i =0;
                foreach ($instrument as $eachInstrument) { 
                      $i++;    
                ?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                        <img width="100" src="uploads/cover/<?=$eachInstrument['cover']?>">
                        <a class="link-dark d-block text-center" href="uploads/files/<?=$eachInstrument['file']?>"><?=$eachInstrument['title']?></a>
                    </td>
                    
                    <td>
                        <?php if ($owner == 0) {
                            echo "undefined";
                        } else {
                            foreach ($owner as $eachOwner){
                                if ($eachOwner['id'] == $eachInstrument['owner_id']) {
                                    echo $eachOwner['name'];
                                }
                            }
                        }
                         ?>
                    </td>
                    <td><?= $eachInstrument['description']?></td>
                    <td>
                        <?php if ($categories == 0) {
                                echo "undefined";
                            } else {
                                foreach ($categories as $eachCategories){
                                    if ($eachCategories['id'] == $eachInstrument['category_id']) {
                                        echo $eachCategories['name'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php if ($owner == 0) {
                                echo "undefined";
                            } else {
                                foreach ($owner as $eachOwner){
                                    if ($eachOwner['id'] == $eachInstrument['owner_id']) {
                                        echo $eachOwner['phone_number'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <a href="edit-instrument.php?id=<?=$eachInstrument['id']?>" class="btn btn-warning">Edit</a>
                        <a href="php/delete-instrument.php?id=<?=$eachInstrument['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
            <?php if ($categories == 0) { ?>
                <div class="alert alert-warning text-center p-5" role="alert">
                    <img src="img/empty.png" width="80"> <br>
                    There isn't any Musical Categories in the database
		        </div>
            <?php } else { ?>

            <!--list all instrument category-->
            <h4 class="mt-5">All Categories</h4>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Instrument Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j = 0;
                    foreach ($categories as $eachCategories) {
                          $j++;
                    ?>
                    <tr>
                        <td><?=$j?></td>
                        <td><?=$eachCategories['name']?></td>
                        <td>
                            <a href="edit-category.php?id=<?=$eachCategories['id']?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-category.php?id=<?=$eachCategories['id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <?php if ($owner == 0) { ?>
                <div class="alert alert-warning text-center p-5" role="alert">
                    <img src="img/empty.png" width="80"> <br>
                    There isn't any Instrument Owners in the database
		        </div>
            <?php } else { ?>
                <!--list all instrument owners-->
                <h4 class="mt-5">All Owners</h4>
                <table class="table table-bordered shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Instrument Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $k = 0;
                        foreach ($owner as $eachOwner) {
                            $k++;
                        ?>
                        <tr>
                            <td><?=$k?></td>
                            <td><?=$eachOwner['name']?></td>
                            <td>
                                <a href="edit-owner.php?id=<?=$eachOwner['id']?>" class="btn btn-warning">Edit</a>
                                <a href="php/delete-owner.php?id=<?=$eachOwner['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
    </div>
</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>