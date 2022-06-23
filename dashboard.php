<?php

require_once 'function.php';

$data = getData('SELECT * FROM qr');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./asset/logo-removebg-preview.png" type="image/x-icon">
    <title>Dashboard - Akses Prima Indonesia</title>

    <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="./asset/img/logo-removebg-preview.png" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

</head>

<body>
    <header class="text-center my-5">
        <h1>Dashboard</h1>
    </header>
    <section class="">
        <div class="row mb-5 p-0 m-0">
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="chartDonat ">
                    <canvas id="donat"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chartBar">
                    <canvas id="bar"></canvas>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-lg-12">
                <table id="table" class="cell-border row-border hover compact stripe">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Kawasan</th>
                            <th class="text-center">Tanggal & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td class="text-center"><?= $i; ?></td>
                                <td><?= $d['kawasan'] ?></td>
                                <td class="text-center"><?= $d['tanggal'] ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url() ?>/asset/js/script.js"></script>
    <script>
        const xhr = new XMLHttpRequest;

        xhr.addEventListener('load', function() {
            const jsonRes = JSON.parse(xhr.response);
            const totalcluster = jsonRes['total'];

            console.log(jsonRes);

            let label = [];

            totalcluster.forEach((val, key, arr) => {
                label.push(val['kawasan']);
            });

            let data = [];

            totalcluster.forEach((val, key, arr) => {
                data.push(parseInt(val['total']));
            });

            const myDonatChart = new Chart(
                document.getElementById('donat'), {
                    type: 'doughnut',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'My First Dataset',
                            data: data,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                }
            );

            const myBarChart = new Chart(
                document.getElementById('bar'), {
                    type: 'bar',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'My First Dataset',
                            data: [65, 59, 80, 81, 56, 55, 40],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            );
        })

        xhr.open('POST', '<?= base_url() ?>' + 'api.php');
        xhr.send();

        $(document).ready(function() {
            $("#table").DataTable();
        });
    </script>
</body>

</html>