<?php

try {

    /*
     * This regex allow only that :
     * - Start with a letter (not case-sensitive) or a dot
     * - End with a letter (not case-sensitive) or a number
     * - Can not contain more than 2 _ or - in a row
     * - 3 min and 32 max
     */
    $regex = "/^[a-zA-Z.](?!.*?[_-]{2})[a-zA-Z0-9_-]{1,58}[a-zA-Z0-9]$/";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $filename = $_POST['name']; // File name
        $path = $_POST['path']; // Actual path
        if (!is_dir($path)) { echo "Invalid location"; return; } // If path is invalid
        // Check if the filed name is safe
        if (!preg_match_all($regex, $filename)) { echo "Invalid directory name (must be only letters (no accents), numbers, _ or -, 3 characters min and 60 max)"; return; }

        // Create the file
        $execString = "sudo touch " . $path.$filename;
        $output = exec($execString);

        echo $output;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}