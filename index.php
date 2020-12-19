<?php
$urlrecent = 'https://www.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=928c834ae2e13e2e7006bd4f90e7bad3&per_page=15&format=rest';

$urlrecent = file_get_contents($urlrecent);
$recent = simplexml_load_string($urlrecent);
$recentphoto = $recent->photos->photo;

$urlpopular = 'https://www.flickr.com/services/rest/?method=flickr.photos.getPopular&api_key=928c834ae2e13e2e7006bd4f90e7bad3&user_id=123653963%40N02&per_page=15&format=rest';
$urlpopular = file_get_contents($urlpopular);
$popular = simplexml_load_string($urlpopular);
$popularphoto = $popular->photos->photo;

// var_dump($recentphoto);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="height: 60px;">
            <div class="container-fluid container">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse pl-2" id="navbarExample01" style="font-size: large;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="recentphoto.php">Recent Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="popularphoto.php">Popular Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>

                    <!-- Search form -->
                    <form method="POST" action="search.php" class="form-inline d-flex justify-content-center md-form form-sm mt-0 border-bottom" style="height: 30px;">
                        <i class="fas fa-search pt-2" aria-hidden="true"></i>
                        <input class="form-control form-control-sm ml-3 w-100 border-0 p-2" style=" font-size: large;" type="text" placeholder="Search" aria-label="Search" name="search">
                    </form>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

        <!-- Jumbotron -->
        <div class="p-5 text-center bg-light" style="margin-top: 58px">
            <h1 class="mb-3">Get Images for Your Needs</h1>
            <h4 class="mb-3">Platform that give your images that you cant believe</h4>
        </div>
        <!-- Jumbotron -->
    </header>

    <!-- Recent Photo -->
    <div class="container pt-5">
        <h2 class="px-3 text-dark">Recent Photos</h2>
        <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-5 g-2 g-lg-4">
            <?php foreach ($recentphoto as $photo) : ?>
                <?php $alamat = 'https://farm' . $photo['farm'] . '.staticflickr.com/' .
                    $photo['server'] . '/' .
                    $photo['id'] . '_' .
                    $photo['secret'] . '.jpg'; ?>
                <div class="col">
                    <div class="p-3">
                        <img src="<?= $alamat ?>" class="d-block" width=250px height=250px alt="..." />
                        <p class="pt-1">
                            <?= $photo['title'] ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="p-3 text-center bg-light">
    </div>

    <!-- Popular Photo -->
    <div class="container pt-5">
        <h2 class="px-3 text-dark">Popular Photos</h2>
        <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-5 g-2 g-lg-4">
            <?php foreach ($popularphoto as $photo) : ?>
                <?php $alamat = 'https://farm' . $photo['farm'] . '.staticflickr.com/' .
                    $photo['server'] . '/' .
                    $photo['id'] . '_' .
                    $photo['secret'] . '.jpg'; ?>
                <div class="col">
                    <div class="p-3">
                        <a href="<?= $alamat ?>" data-toggle="lightbox">
                            <img src="<?= $alamat ?>" class="d-block" width=250px height=250px alt="..." />
                        </a>
                        <p class="pt-1">
                            <?= $photo['title'] ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>
</body>

</html>