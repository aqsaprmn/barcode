<?php

require_once 'connect.php';

mysqli_query($conn, "INSERT INTO qr VALUES ('', 'Cluster 4',now())");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cluster 4 - Akses Prima Indonesia</title>
    <link rel="shortcut icon" href="./asset/logo-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="./asset/css/style.css">
</head>

<body>
    <div>
        <img class="logo" src="./asset/logo_api-removebg-preview.png" alt="">
        <h1>Cluster 4</h1>
        <h3>Terimakasih sudah melakukan sacaning QR</h3>
        <p>Silhkan tekan tombol Whatsapp</p>
        <p>Untuk melanjutkan berlangganan internet</p>
        <img src="./asset/logowa.png" alt="">
        <a target="blank" href="https://api.whatsapp.com/send/?phone=081212129751&text=Halo Admin... Saya ingin berlangganan internet...">WhatsApp</a>
    </div>
</body>

</html>