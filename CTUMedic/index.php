<?php
    define("BASE_URL", "/Projects/CTUMedic");
    define("BASE_STYLE", BASE_URL . "/Frontend/assets/styles");
    define("BASE_SCRIPT", BASE_URL . "/Frontend/assets/scripts");
    define("BASE_IMAGE", BASE_URL . "/Frontend/assets/images");
    define("BASE_COMPOPNENT", __DIR__ . "/Frontend/components");

    $page = $_GET["page"] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTUMedic</title>
    <link rel="stylesheet" href="<?php echo BASE_STYLE ?>/style.css">
    <link rel="stylesheet" href="<?php echo BASE_STYLE ?>/index.css">
    <link rel="stylesheet" href="<?php echo BASE_STYLE ?>/header.css">
    <link rel="stylesheet" href="<?php echo BASE_STYLE ?>/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_STYLE ?>/home.css">


    <link rel="icon" href="<?php echo BASE_IMAGE ?>/icons/IconCTUMedic.png">
</head>

<body>
    <div class="container">
        <?php include BASE_COMPOPNENT . '/header.php'; ?>
        <div class="main">
            <?php
                $views = [
                    'home'                  => '/Frontend/views/home.php',
                    'login'                 => '/Frontend/views/DangNhap/login.php',
                    'register'              => '/Frontend/views/DangNhap/register.php',
                    'benhnhan'              => '/Frontend/views/BenhNhan/benhnhan.php',
                    'datlich'      => '/Frontend/views/BenhNhan/datlich.php',
                    'bacsi'                 => '/Frontend/views/BacSi/bacsi.php',
                    'quanly'                => '/Frontend/views/QuanLy/quanly.php',
                    'thembacsi'      => '/Frontend/views/QuanLy/thembacsi.php',
                ];

                if (array_key_exists($page, $views) && file_exists(__DIR__ . $views[$page])) {
                    include __DIR__ . $views[$page];
                } else {
                    echo '404 - NOT FOUND';
                }
            ?>
        </div>


        <?php include BASE_COMPOPNENT . '/footer.php'; ?>
    </div>
</body>
<script src="<?php echo BASE_SCRIPT ?>script.js"></script>

</html>