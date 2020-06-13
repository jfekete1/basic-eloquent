<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/./config/bootstrap.php';
require __DIR__.'/./config/core.php';
require __DIR__.'/libs/globalFunctions.php';

include_once __DIR__.'/libs/php-jwt-master/src/BeforeValidException.php';
include_once __DIR__.'/libs/php-jwt-master/src/ExpiredException.php';
include_once __DIR__.'/libs/php-jwt-master/src/SignatureInvalidException.php';
include_once __DIR__.'/libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

$sJson = file_get_contents("php://input");
$data = json_decode_nice($sJson);

//Log the user in checking the username and password he provided !
/*$asdf = gettype($data);
echo $asdf;
exit;
//if(array_key_exists("username",$data)){
*/
if(isset($data->username)){
    $user = UsersModel::where('username', $data->username)->first();
}
else{
    http_response_code(401);
    echo json_encode(
        array(
            "message" => "Invalid Username or Password !",
        )
    );
    exit;
}


if ($user && verify_pwd($data->password, $user->password)) {

    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "username" => $user->username,
            "user_id" => $user->user_id,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "email" => $user->email
        )
    );

    http_response_code(200);
    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Successful login.",
            "jwt" => $jwt
        )
    );
} else {
    http_response_code(401);
    echo json_encode(
        array(
            "message" => "Invalid Username or Password !",
        )
    );
}

//$lastUser = UsersModel::orderby('user_id', 'desc')->first();
