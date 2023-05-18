<?php

/**
 * QUERY DEFINE TABLE
 */
define('QRYADM', 'SELECT * FROM `bunkodex_admin` ');
define('QRYCAT', 'SELECT * FROM `bunkodex_cat` ');
define('QRYSCAT', 'SELECT * FROM `bunkodex_subcat` ');
define('QRYPRO', 'SELECT * FROM `bunkodex_product` ');
define('QRYLOG', 'SELECT * FROM `bunkodex_log` ');
/*---------------------------------------------------------------------------------------- */

/**
 * Function for read a JSON file
 */
function read_json($file_path) {
    $json_string = file_get_contents($file_path);
    $data = json_decode($json_string, true);
    return $data;
}
/**
 * FUNZIONE PER VERIFICARE LA VERISIONE ATTUALE.
 * FUNCTION FOR CHECK CHE ACTUAL VERSION ON THE TS SITE
 */
function check_version() {
    $data = read_json('../bunkodex.json');
    $ondataurl = $data['urlupdate'];
    $ondatadec = read_json($ondataurl);

    $curver = str_replace('v', '', $data['version']);
    $newver = str_replace('v', '', $ondatadec['version']);

    if (version_compare($curver, $newver) !== 0) {
        $message = "<h1>NEW VERSION AVAIABLE!</h1><a href='https://maccacomputer.altervista.org/product/bunkodex/?curr=$curver'>";
    } else {
        $message = "";
    }
    return $message;

}

/**
 * Funzione per evitare attacchi SQL Injection e XSS.
 * Function for prevent SQL Injection and XSS Attacks
 */
function html_string($string)
{
    $string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $string = trim($string);
    $string = addslashes($string);
    return $string;
}

/**
 * GET THE REAL USER IP
 */
function getIPAddress() {  
	//whether ip is from the share internet  
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
		$ip = $_SERVER['HTTP_CLIENT_IP'];  
	}  
	//whether ip is from the proxy  
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	//whether ip is from the remote address
	else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}