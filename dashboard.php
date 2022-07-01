<!-- <?php

        require_once 'function.php';

        $data = getData('SELECT * FROM qr');

        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="row m-0">
            <div class="col-sm-1 ps-5">
                <img style="width:200px ;" src="<?= base_url() ?>asset/img/logo_api-removebg-preview.png" class="mb-4" alt="">
            </div>
            <div class="col-sm-11">
                <h1>Dashboard</h1>
            </div>
        </div>
    </header>
    <section class="">
        <div class="row justify-content-around mb-5 px-5 m-0">
            <div class="col-lg-5 mb-4 shadow-lg border border-gray py-4 rounded">
                <div class="text-center mb-4">
                    <h5>Total Akses QR Per Kawasan</h5>
                </div>
                <div class="row">
                    <div class="chartDonat mb-4 col-xl-8">
                        <canvas id="donat"></canvas>
                    </div>
                    <div class="col-xl-4 stateDonat d-flex justify-content-center align-self-center">
                        <table class="table">


                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-4 shadow-lg border border-gray">
                <div class="text-center mb-4">
                    <h5>Total Akses QR Per Tanggal</h5>
                </div>
                <div class="row justify-content-end">
                    <div class="col-4"><input id="month" type="month" value="<?= date("Y-m"); ?>" class="form-control"></div>
                </div>
                <div class="chartBar" style="height: 100%;">
                    <canvas id="bar"></canvas>
                </div>
            </div>
        </div>
        <div class="row px-5 mx-0 pb-5">
            <div class="col-lg-12 overflow-auto p-5 shadow-lg border border-gray rounded">
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
                                <td class="text-center p-2"><?= $i; ?></td>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script src="<?= base_url() ?>/asset/js/script.js"></script>
    <script>
        const xhr = new XMLHttpRequest;

        xhr.addEventListener('load', function() {
            const jsonRes = JSON.parse(xhr.response);
            const totalcluster = jsonRes['kawasan'];
            const month = document.getElementById('month');

            month.addEventListener('change', function() {
                const xhr = new XMLHttpRequest;
                xhr.open('POST', '<?= base_url() ?>' + 'api.php');
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send('date=' + this.value);
                xhr.addEventListener('load', function() {
                    const jsonRes = JSON.parse(xhr.response);
                    const total = jsonRes['tanggal'];

                    const date = [];
                    // const datelabel = [];

                    jsonRes['tanggal'].forEach((val, index, arr) => {
                        date.push({
                            x: Date.parse(val['tanggal']),
                            y: val['total']
                        })

                        // datelabel.push(val['total']);
                    });

                    updateChart(myBarChart, date);
                })
            })

            const doughnutLabelLines = {
                id: 'doughnutLabelLines',
                afterDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            top,
                            bottom,
                            left,
                            right,
                            width,
                            height
                        }
                    } = chart;
                    chart.data.datasets.forEach((dataset, i) => {
                        chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
                            const {
                                x,
                                y
                            } = datapoint.tooltipPosition();

                            console.log(x);

                            const halfwidth = width / 2;
                            const halfheight = height / 2;

                            const xLine = x >= halfwidth ? x + 15 : x - 15;
                            const yLine = x >= halfheight ? y + 15 : y - 15;
                            const extraLine = x >= halfwidth ? 15 : -15;

                            ctx.beginPath();
                            ctx.moveTo(x, y);
                            ctx.lineTo(xLine, yLine);
                            ctx.lineTo(xLine + extraLine, yLine);
                            ctx.strokeStyle = dataset.borderColor[index];
                            ctx.stroke();

                            const textwidth = ctx.measureText(chart.data.labels[index]).width;
                            const textPosition = x >= halfwidth ? 'left' : 'right';
                            const plusFivePx = x >= halfwidth ? 5 : -5;
                            ctx.textAlign = textPosition;
                            ctx.textBaseLine = 'middle';
                            ctx.fillstyle = dataset.borderColor[index];
                            ctx.fillText(chart.data.labels[index], xLine + extraLine + plusFivePx, yLine);
                        })
                    })
                }
            }

            let label = [];

            totalcluster.forEach((val, key, arr) => {
                label.push(val['kawasan']);
            });

            let data = [];

            totalcluster.forEach((val, key, arr) => {
                data.push(parseInt(val['total']));
            });

            const stateDonat = document.querySelector('.stateDonat');
            const tableDonat = stateDonat.querySelector('table');

            let trDonat = ``;
            let colorDonat = getColorLabel(data.length);

            data.forEach((val, index, arr) => {
                trDonat += `<tr>
                        <td style="padding:10px"><span style="position:relative; display: block; width:20px; height: 20px; background-color:${colorDonat[index]}; border:1px solid black;"><span></td>
                        <td>${label[index]} </td>
                        <td colspan="3" class="text-center"> = </td>
                        <td class="text-center"><b>${data[index]}</b></td>
                </tr>`;
            });

            tableDonat.innerHTML = trDonat;

            const myDonatChart = new Chart(
                document.getElementById('donat'), {
                    type: 'doughnut',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'My First Dataset',
                            data: data,
                            backgroundColor: getColorLabel(data.length),
                            borderColor: 'black',
                            borderWidth: 1,
                            hoverOffset: 4,
                            cutout: '80%',
                            borderRadius: 20,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: 10,
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            datalabels: {
                                color: 'black'
                            },
                            title: {
                                display: false,
                                text: 'Total Per Kawasan',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font: {
                                    size: 20
                                }

                            }
                        }
                    },
                    plugins: [ChartDataLabels],
                }
            );

            const date = [];
            // const datelabel = [];

            jsonRes['tanggal'].forEach((val, index, arr) => {
                date.push({
                    x: Date.parse(val['tanggal']),
                    y: val['total']
                })

                // datelabel.push(val['total']);
            });

            const myBarChart = new Chart(
                document.getElementById('bar'), {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Total Per Tanggal',
                            data: date,
                            backgroundColor: 'rgb(75, 192, 192,0.5)',
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0,
                            borderWidth: 2
                        }]
                    },
                    // plugins: [ChartDataLabels],
                    options: {
                        // maintainAspectRatio: false,
                        layout: {
                            // padding: {
                            //     top: 30,
                            //     bottom: 30
                            // },
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: false,
                                text: 'Total Per Tanggal',
                                // padding: {
                                //     top: 10,
                                //     bottom: 30
                                // },
                                font: {
                                    size: 20
                                }
                            },
                            // datalabels: {
                            //     anchor: 'end',
                            //     labels: datelabel,
                            // },

                        },
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day',
                                },
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            },
                        }
                    },

                }
            );
        })

        // xhr.open('POST', '<?= base_url() ?>' + 'api.php');
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("date=" + month.value);



        $(document).ready(function() {
            $("#table").DataTable();
        });

        function updateChart(chart, mydata) {
            // console.log(chart.data, mydata);
            chart.data.datasets.forEach((dataset) => {
                dataset.data = mydata;
            });
            chart.update();
        }
    </script>
</body>

</html> -->