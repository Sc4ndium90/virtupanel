<?php

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $id = htmlspecialchars($id);
        if (!is_numeric($id)) { echo "The given PID was NaN"; return; }

        $execString = "sudo /usr/bin/kill -s 9 $id 2>&1";
        $output = exec($execString);

        echo $output;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}