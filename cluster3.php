<?php

require_once 'function.php';

mysqli_query($conn, "INSERT INTO qr VALUES ('', 'Cluster 3',now()," . date('m') . "," . date("Y") . ")");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./asset/img/logo-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="./asset/css/style.css">
    <title>Cluster 3 - Akses Prima Indonesia</title>
</head>

<body>
    <div class="cluster">
        <img class="logo" src="<?= base_url() ?>asset/img/logo_api-removebg-preview.png" alt="">
        <h1>Cluster 3</h1>
        <h3>Terimakasih sudah melakukan sacaning QR</h3>
        <p>Silhkan tekan tombol Whatsapp</p>
        <p>Untuk melanjutkan berlangganan internet</p>
        <img src="<?= base_url() ?>asset/img/logowa.png" alt="">
        <a target="blank" href="https://api.whatsapp.com/send/?phone=6281212129751&text=Halo Admin... Saya ingin berlangganan internet...">WhatsApp</a>
    </div>


</body>

</html>