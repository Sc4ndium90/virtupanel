<?php

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $id = htmlspecialchars($id);
        if (!is_numeric($id)) { echo "The given PID was NaN"; return; }

        $execString="su virtupanel -c 'sudo kill $id 2>&1'"; //Command to execute
        $output = exec($execString);

        echo $output;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}