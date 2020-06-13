<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/libs/globalFunctions.php';

$data = json_decode_nice(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";

decode_JWT($jwt);