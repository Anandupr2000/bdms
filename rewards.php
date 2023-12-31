<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .row {
            display: -webkit-box;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .yourPoints {
            margin-bottom: 2em;
            text-align: center;
        }

        .yourPoints h2 {
            color: #000;
            font-size: 2.5em;
        }

        .yourPoints h1 {
            color: #000;
            font-size: 3em;
            font-weight: 700;
        }

        .yourPoints small {
            display: block;
            font-size: .5em;
        }

        #pageHight {
            /* min-height: calc(100vh - 505px); */
            height: 30rem;
            min-width: 30rem;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .donut_singleContainer {
            background-color: #fff;
            border: 1px solid #eff2f6;
            background-color: transparent;
            /* border-radius: 40px 40px 40px 0; */
            /* margin: 15px 0; */

        }

        .donut_single {
            position: relative;
            z-index: 1;
        }

        .prog {
            left: 50%;
            max-width: 50px;
            position: absolute;
            text-align: center;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 100%;
            z-index: 2;
        }

        .donut_singleWrapper {
            position: relative;
        }

        .checkMark path {
            -webkit-animation: draw 0.5s linear forwards 1s;
            -ms-animation: draw 0.5s linear forwards 1s;
            animation: draw 0.5s linear forwards 1s;
            fill: none;
            stroke: #529c29;
            stroke-miterlimit: 10;
            stroke-width: 40px;
            stroke-dasharray: 500;
            stroke-dashoffset: 500;
        }

        .checkMark svg {
            overflow: visible;
        }

        .donut_single div[dir=ltr] {
            margin: 0 auto;
        }

        .donut_single * {
            max-width: 100%;
        }

        .progressTracker {
            -webkit-align-content: center;
            -ms-align-content: center;
            align-content: center;
            -webkit-align-items: center;
            -ms-align-items: center;
            align-items: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            justify-content: center;
            min-height: 65px;
            padding: 0 15px 15px;
            text-align: center;
        }

        .progressTracker .container-login100-form-btn {
            margin: 0 auto;
            max-width: 220px;
        }

        @-webkit-@keyframes draw {
            from {
                stroke-linecap: round;
            }

            to {
                stroke-linecap: round;
                stroke-dashoffset: 0;
            }
        }

        @-ms-@keyframes draw {
            from {
                stroke-linecap: round;
            }

            to {
                stroke-linecap: round;
                stroke-dashoffset: 0;
            }
        }

        @keyframes draw {
            from {
                stroke-linecap: round;
            }

            to {
                stroke-linecap: round;
                stroke-dashoffset: 0;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <div class="container border border-3 rounded-lg" id="pageHight">
        <div class="yourPoints" data-yourpoints="<?php echo $points ?>">
            <h2>You have</h2>
            <h1 style="display:flex;justify-content:center;align-items: baseline;"><?php echo $points ?> <small>points</small></h1>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <div class="row">
            <div class="col-md-12">
                <div class="donut_singleContainer" data-reward="<?php echo $rewardPoints ?>" data-link="#">
                    <div class="donut_singleWrapper col" style="position: relative;">
                        <div class="donut_single"></div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" style="width: 1000px;position:absolute;left:14%" role="document">
                                <div class="modal-content">
                                    <div class="modal-body" style="position:absolute;width: 1000px;padding:25px 50px;margin:0 auto">
                                    <?php
                                    require('coupons.html')
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    jQuery(document).ready(function() {
        jQuery('.donut_singleContainer').each(function(idx) {
            var yourPoints = jQuery('.yourPoints').data('yourpoints'),
                reward = jQuery(this).data('reward'),
                link = jQuery(this).data('link'),
                prog = yourPoints * 100 / reward,
                con = prog.toString().indexOf('.'),
                cont = '',
                cont1 = '<div class="progressTracker">Remain points to claim ' + (reward - yourPoints) + '</div>';
            if (con > 0) {
                cont = prog.toFixed(2) + '%';
            } else if (prog >= 100) {
                cont = '<div class="checkMark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 166 150.9"><path d="M0.3 96l62.4 54.1L165.6 0.3"/></svg></div>';
                cont1 = `<div class="progressTracker">
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <a class="login100-form-btn" data-toggle="modal" data-target="#exampleModalCenter">Claim Reward</a>
                        </div>
                    </div>
                </div>`
            } else {
                cont = prog + '%';
            }

            if (jQuery(this).find('.donut_single').attr('id') == undefined) {
                jQuery(this).find('.donut_single').attr('id', 'donut_single' + idx);
            }

            var id = jQuery(this).find('.donut_single').attr('id');
            let pr = (prog > 100) ? 100 : prog,
                rm = ((100 - prog) < 0) ? 0 : (100 - prog);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Effort', 'Amount given'],
                    ['My all', pr],
                    ['Remain', rm],
                ]);
                var options = {
                    pieHole: .75,
                    pieSliceTextStyle: {
                        color: 'transparent',
                    },
                    legend: 'none',
                    tooltip: {
                        trigger: 'none'
                    },
                    slices: {
                        0: {
                            color: '#6a80ec'
                        },
                        1: {
                            color: 'transparent',
                        }
                    }
                };
                var chart = new google.visualization.PieChart(document.getElementById(id));
                chart.draw(data, options);
            }
            jQuery(this).find('.donut_singleWrapper').append('<div class="prog">' + cont + '</div>');
            jQuery(this).append(cont1);
        });
    });
</script>

</html>