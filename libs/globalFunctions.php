<?php
require __DIR__.'/../config/bootstrap.php';

// required to encode json web token
include_once __DIR__.'./php-jwt-master/src/BeforeValidException.php';
include_once __DIR__.'./php-jwt-master/src/ExpiredException.php';
include_once __DIR__.'./php-jwt-master/src/SignatureInvalidException.php';
include_once __DIR__.'./php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

function json_decode_nice($json, $assoc = FALSE)
{
    $json = str_replace(array("\n", "\r"), "", $json);
    $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/', '$1"$3":', $json);
    $json = preg_replace('/(,)\s*}$/', '}', $json);
    return json_decode($json, $assoc);
}

function verify_pwd($sentPwd, $realPwd)
{
    //Find sitemask value in cms_siteprefs table
    $sitemask = SiteprefsModel::where('sitepref_name', 'sitemask')->first();
    $hashedPwd = md5($sitemask->sitepref_value . $sentPwd);
    if ($hashedPwd === $realPwd) {
        return true;
    } else {
        return false;
    }
}


function decode_JWT($jwt)
{
    include_once __DIR__.'/../config/core.php';
    //$data = json_decode_nice(file_get_contents("php://input"));
    //$jwt = isset($data->jwt) ? $data->jwt : "";

    if ($jwt) {
        // if decode succeed, show user details
        try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            $user = UsersModel::where('username', $decoded->data->username)->first();

            if ($user) {
                // set response code
                http_response_code(200);

                // response in json format
                echo json_encode(
                    array(
                        "message" => "YOUR TOKEN IS VALID.",
                        "jwt" => $jwt,
                        "username" => $decoded->data->username,
                        "user_id" => $decoded->data->user_id,
                        "first_name" => $decoded->data->first_name,
                        "last_name" => $decoded->data->last_name,
                        "email" => $decoded->data->email,
                        "Document_ROOT" => __DIR__,
                    )
                );
            }
            // message if unable to update user
            else {
                // set response code
                http_response_code(401);

                // show error message
                echo json_encode(array("message" => "Bad token"));
            }
        }

        // if decode fails, it means jwt is invalid
        catch (Exception $e) {

            // set response code
            http_response_code(401);

            // show error message
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    }

    // show error message if jwt is empty
    else {

        // set response code
        http_response_code(401);

        // tell the user access denied
        echo json_encode(array("message" => "Access denied."));
    }
}
