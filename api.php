<?php
require_once 'connect.php';
require_once 'function.php';

$data['total'] = getData("SELECT kawasan, COUNT(kawasan) AS total FROM qr Group BY kawasan");
$data['cluster'] = getData("SELECT * FROM qr");


echo json_encode($data);
