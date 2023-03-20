<?php

try {

    $execString='ps aux'; //Command to execute
    $output=[]; $results=[]; // Pre-init two arrays, one for raw data and one for outputing the correct result
    exec($execString, $output); // Execute the command and add the output to output array
    foreach ($output as $item) {$results[] = preg_split('/\s+/', $item);} // For each item in the output array, remove all the spaces and out them in the results array
    unset($results[0]); // Remove the first entry because it contains columns names
    foreach ($results as $index => $result) {

        // If the array contains more than 11 values (commands with options), then join the command options with the command
        if (sizeof($result) > 11) {
            $indices = [10, sizeof($result) - 1];
            $sum = "";

            // Loop to sum all the pieces
            for($i = $indices[0]; $i <= $indices[1]; $i++){
                $sum .= $result[$i] . " ";
                unset($results[$index][$i]);
            }
            // Replace the last value to the right text
            $results[$index][10] = $sum;
        }
    }

    // Return the array values in json
    echo json_encode(array_values($results));

} catch (Exception $e) {
    echo $e->getMessage();
}
