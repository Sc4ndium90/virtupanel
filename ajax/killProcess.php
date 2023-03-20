<?php

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $id = htmlspecialchars($id); // Escape special chars
        if (!is_numeric($id)) { echo "The given PID was NaN"; return; } // If not a number then return

        $execString = "sudo /usr/bin/kill -s 9 $id 2>&1"; // Kill the process
        $output = exec($execString);

        echo $output;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}