<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
 
// variables used for jwt
$key = "zegprogr_vmk";
$iss = "https://www.zegprogram.hu/";
$aud = "https://www.zegprogram.hu/";
$iat = 1591808887;
$nbf = 1591808887;
?>