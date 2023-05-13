<?php
/**
 * Function for read a JSON file
 */
function read_json($file_path) {
    $json_string = file_get_contents($file_path);
    $data = json_decode($json_string, true); // se vuoi un array associativo invece di un oggetto
    return $data;
}