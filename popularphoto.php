<?php
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$i = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$pages = 9 + $i;
$url = 'https://www.flickr.com/services/rest/?method=flickr.photos.getPopular&api_key=928c834ae2e13e2e7006bd4f90e7bad3&user_id=123653963%40N02&page=' . $halaman . '&per_page=20&format=rest';


$url = file_get_contents($url);
$popular = simplexml_load_string($url);
$popularphoto = $popular->photos->photo;

function nextpage($halaman)
{
    return $halaman++;
}

function prevpage($halaman)
{
    return $halaman--;
}

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
    <!-- style -->

</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="height: 60px;">
            <div class="container-fluid container">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse p-2 bg-white" id="navbarExample01" style="font-size: large;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="recentphoto.php">Recent Photo</a>
                        </li>
                        <li class="nav-item active">
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
    </header>

    <div class="container">
        <h2 class="px-3 text-dark" style="padding-top: 80px;">Popular Photos</h2>
        <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-5 g-2 g-lg-4">
            <?php foreach ($popularphoto as $photo) : ?>
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
        <div class="d-flex justify-content-center" style="padding-bottom: 30px;">
            <nav aria-label="..." class="pt-5">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php for ($i = $i - 1; $i < $pages; $i++) {
                        if ($i == 0) {
                        } else { ?>
                            <li class="page-item"><a class="page-link" style="font-size: large;" href="?halaman=<?= $i ?>"><?= $i; ?></a></li>
                    <?php }
                    } ?>
                    <li class="page-item disabled">
                        <a class="page-link" onclick=''>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"></script>
</body>

</html>