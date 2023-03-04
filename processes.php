<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Styles -->
    <!-- Bootstrap 5.2 -->    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- DataTables BS5 -->   <link href="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.css" rel="stylesheet" />
    <!-- DataTables -->       <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet" />

    <style>.toolbar {float: left;}</style>

    <title>VirtuPanel - Processes</title>
</head>
<body>

    <!-- Side Navbar -->
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/components/navbar/navbar.html" ?>


</body>

    <!-- Scripts -->
    <!-- Bootstrap 5.2 -->    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Popper -->           <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- jQuery -->           <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- DataTables -->       <script src="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.js"></script>
    <!-- SweetAlert -->       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="js/processes.js"></script>
    <script>
        $(document).ready(function() {
            $('a[href="' + this.location.pathname + '"]').addClass('active');

            console.log(this.location.pathname)
        });
    </script>

</html>