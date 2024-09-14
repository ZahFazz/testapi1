<?php
use \Firebase\JWT\JWT;

function generate_jwt($user_id) {
    include_once '../config/core.php';
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id" => $user_id
       )
    );

    return JWT::encode($token, $key);
}

function validate_jwt($jwt) {
    include_once '../config/core.php';
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        return $decoded->data->id;
    } catch (Exception $e) {
        return null;
    }
}
?>
