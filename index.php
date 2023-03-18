<?php

    /*
     * Get CPU information
     */
    $loads = sys_getloadavg();
    $core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l")); // Retrieve the amount of cores in the VM
    $load = round($loads[0]/($core_nums + 1)*100, 1);


    /*
     * Get RAM information
     */
    $exec_free = explode("\n", trim(shell_exec('free')));
    $get_mem = preg_split("/[\s]+/", $exec_free[1]);
    $mem_percentage = round($get_mem[2]/$get_mem[1]*100, 0);
    $mem_gb = number_format(round($get_mem[2]/1024/1024, 2), 2) . '/' . number_format(round($get_mem[1]/1024/1024, 2), 2);


    /*
     * Get Storage information
     */

    $storage_percentage = round((disk_total_space("/") - disk_free_space("/")) / disk_total_space("/") * 100, 1);
    $storage_usage = round((disk_total_space("/") - disk_free_space("/")) / 1024**3, 1);
    $storage_max = round(disk_total_space("/") / 1024**3, 1);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Styles -->
    <!-- Bootstrap 5.2 -->    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Local -->            <link href="./styles/style.css" rel="stylesheet">

    <title>VirtuPanel - Home</title>
</head>
<body class="d-flex">

    <!-- Side Navbar -->
    <?php require "./components/navbar/navbar.php"; ?>

    <div class="d-flex flex-column container pt-5">

        <h1>Home</h1>
        <hr>

        <div class="row">
            <div class="col-4">
                <!-- Card about processor -->
                <div class="card specs-card">
                    <div class="card-body ">
                        <h4><svg class="bi pe-none me-2" width="25" height="25"><use xlink:href="#processor"></use></svg> Processor</h4>
                        <ul>
                            <li>Usage : <?= $load ?> %</li>
                            <li>Number of cores : <?= $core_nums ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <!-- Card about RAM -->
                <div class="card specs-card">
                    <div class="card-body">
                        <h4><svg class="bi pe-none me-2" width="25" height="25"><use xlink:href="#ram"></use></svg> RAM</h4>
                        <ul>
                            <li>Usage : <?= $mem_gb ?>GB (<?= $mem_percentage ?>%)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <!-- Card about storage -->
                <div class="card specs-card">
                    <div class="card-body">
                        <h4><svg class="bi pe-none me-2" width="25" height="25"><use xlink:href="#disk"></use></svg> Disk</h4>
                        <ul>
                            <li>Usage : <?= $storage_usage ?>/<?= $storage_max ?>GB (<?= $storage_percentage ?>%)</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>

    <!-- Scripts -->
    <!-- Bootstrap 5.2 -->    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Popper -->           <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- jQuery -->           <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        $(document).ready(function() {
            $('a[href="' + this.location.pathname + '"]').addClass('active');
        });
    </script>

</html>