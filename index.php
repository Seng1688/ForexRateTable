<?php include 'function.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forex Rate Table</title>
    <!-- Bootstrap Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

    <body>

        <?php

            $base = 'MYR';
            if (isset($_GET['base'])) {
                $base = $_GET['base'];
            }

            $data = getData($base);
            
            if (!isset($data['error'])) {
                
                $date = $data["date"];
                $timestamp = getFormattedTime($data["timestamp"]);
                $currencies = $data["rates"];
                $modifiedCurrencies = array_map( fn($value) => $value +10.002, $currencies );
        ?>

        <div class="container">

            <div class="row">

                <span style="Font-size: 30px; font-weight: bolder;" class="text-center"><u>Yong Seng's Interview Question
                        Answer</u></span>
                <p style="color: red; font-weight: bold" class="mt-3">Note:
                    <br>
                    1. According to wikipedia , A number is called "even" if it is an integer multiple of 2, thus, any float
                    number will be rounding towards zero before pass as an argument to checkEven function
                    <br>
                    2. Extra feature - users can flexibly change the base currency
                </p>

                <div class="mt-3"> <label><b>Date:</b></label> <?= $date ?> </div>

                <div class="mt-2"><label><b>Time:</b></label> <?= $timestamp ?> </div>

                <div class="d-flex mt-2" style="width: 190px">
                    <label for="base" style="width:100px"><b>Base:</b></label>
                    <select id="base" class="form-select ms-2" style="height: 35px" name="base">

                        <?php foreach ($currencies as $currency => $rate) { ?>

                        <option <?= ($currency == $base )? "selected" : ""; ?> value=<?= $currency ?>> <?= $currency ?>
                        </option>

                        <?php } ?>

                    </select>

                </div>
            </div>

            <div class="row mt-5">

                <div class="col-md-6">

                    <table class="table table-striped table-bordered table-hover ">

                        <thead class="table-dark">
                            <tr>
                                <th>Currency Units</th>
                                <th>Rates</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- Display-->
                            <?php foreach ($currencies as $currency => $rate) {  ?>

                            <tr
                                class="<?= (checkEven($rate) || $currency == "HKD")? "border border-danger border-3" : "" ?>">
                                <th><?= $currency  ?> </th>
                                <td><?= $rate ?></td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>


                </div>

                <div class="col-md-6">

                    <table class="table table-striped table-bordered table-hover ">

                        <thead class="table-dark">
                            <tr>
                                <th>Currency Units</th>
                                <th>Modified Rates</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- Display-->
                            <?php foreach ($modifiedCurrencies as $modifiedCurrency => $rate){  ?>
                            <tr
                                class="<?= (checkEven($rate) || $modifiedCurrency == "HKD")? "border border-danger border-3" : "" ?>">
                                <th><?= $modifiedCurrency  ?> </th>
                                <td><?= $rate ?></td>

                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            } else {
                echo("<div class='alert alert-danger w-75 mx-auto' role='alert'> <h1>{{$data['message']}}</h1></div>");
                }
            ?>

    </body>

</html>

<!-- Bootstrap Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- custom javascript-->
<script defer src="myjs.js"></script>