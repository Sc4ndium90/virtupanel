<?php

// Default path
$path = "/";
$error = null;

// If set in the url (?path=/something), then change the path var
if (isset($_GET['path']) && $_GET['path'] !== "//") {
    if (is_dir($_GET['path'])) {
        $path = $_GET['path'];
    } else {
        $error = "Not found (not a directory?)";
    }
}


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

    <title>VirtuPanel - Files</title>
</head>
<body class="d-flex">

    <!-- Side Navbar -->
    <?php require "./components/navbar/navbar.php"; ?>

    <div class="d-flex flex-column container pt-5">

        <h1>Files</h1>
        <hr>

        <!-- Form to search a specific folder and go in this folder if possible, else reply the error -->
        <div class="pt-2 pb-2">
            <div class="row">
                <div class="col">
                    <form action="files.php" method="GET">
                        <input type="text" name="path" placeholder="Go to path..">
                        <input type="submit" value="Search">
                        <?php if ($error) echo "<span class='text-danger'>$error</span>" ?>
                    </form>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary me-1" id="create-dir-btn">Create Directory 📁</button>
                    <button class="btn btn-primary me-1" id="create-file-btn">Create File 📄</button>
                    <button class="btn btn-danger me-1" id="delete-file-or-folder-btn">Delete File/Directory 📄📁</button>
                </div>
            </div>
        </div>

        <!-- Show the actual path -->
        <div class="pb-2">Location : <span id="path"><?= $path ?></span></div>

        <!-- Container with files and dirs -->
        <div class="overflow-scroll" style="height: 600px">
            <ul class='document-list'>

                <?php

                    // If the path is not "/", then show the go back line
                    if ($path !== "/") {
                        echo "<li><a href='" . $_SERVER['PHP_SELF'] . "?path=". dirname($path . '/') . '/' . "'><span>📁 ⤴️</span></a></li>";
                    }

                    // List all the files and dirs in an array and sort them from A-Z
                    $files = [];
                    if ($dh = opendir($path)) {
                        while ($files[] = readdir($dh));
                        sort($files);
                        closedir($dh);
                    }

                    // List all the files and dirs
                    foreach($files as $file) {
                        $blacklist = array('', '.','..'); // Blacklist the ., .. and empty name dirs
                        if (!in_array($file, $blacklist)) {
                            // If it's a directory, set the directory emote with the name, it can redirect in the dir
                            if (is_dir($path.$file)) echo "<li><a href=". $_SERVER['PHP_SELF'] . '?path='.$path. $file . '/' ."><span>📁 $file</span></a></li>";
                            // If it's a file, then calculate the space taken by the file (from Byte to TB); they can't be opened
                            else {
                                $scale = 0; $scale_values = ["B", "KB", "MB", "GB", "TB"]; // Set the scale to 0 (0 = B, 1 = KB, etc)
                                $size = filesize($path.$file); // Retrieve the filesize in bytes
                                while ($size >= 1000) { // Loop until the file is under 1000, each time adding one to scale and divide size per 1000
                                    $scale++; $size = $size / 1000;
                                }
                                // Output the final string with filesize rounded to one decimal
                                echo "<li><span>📄 $file</span><span class='float-end'>".round($size, 1) . $scale_values[$scale] ."</span></li>";
                            }
                        }
                    }

                ?>

            </ul>
        </div>


    </div>

</body>

    <!-- Scripts -->
    <!-- Bootstrap 5.2 -->    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Popper -->           <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- jQuery -->           <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- SweetAlert -->       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/files.js"></script>
    <script>
        // Set the active class in the navbar
        $(document).ready(function() {
            $('a[href="' + this.location.pathname + '"]').addClass('active');
        });
    </script>

</html>