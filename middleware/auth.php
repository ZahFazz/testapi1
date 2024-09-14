<?php
include_once '../libs/jwt.php';

function is_authenticated() {
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
        $jwt = str_replace('Bearer ', '', $headers['Authorization']);
        $user_id = validate_jwt($jwt);

        if ($user_id) {
            return $user_id;
        }
    }

    http_response_code(401);
    echo json_encode(array("message" => "Access denied."));
    exit();
}
?>
