<?php

require_once 'connect.php';

function getData($data)
{
    global $conn;

    $result = mysqli_query($conn, $data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function base_url()
{
    $server = 'http://localhost/barcode/';
    // $server = 'http://103.242.181.10/barcode/';

    return $server;
}
