<?php

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $path = $_POST['path'];

        if (is_file($path) || is_dir($path)) {
            $execString = "sudo rm -rf " . $path;
            $output = exec($execString);
            echo $output;
        } else {
            echo "Invalid file or directory" ($path); return;
        }

    }

} catch (Exception $e) {
    echo $e->getMessage();
}