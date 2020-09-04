<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);


    if (!isset($data->users_email, $data->users_password)) {
        http_response_code(404);
        echo ("ERROR: Parameters are not correct.");
        die;
    } else {
        $password = test_input($data->users_password);
        $email = test_input(($data->users_email));
        foreach ($data as $key => $value) {
            if (empty($value)) {
                http_response_code(404);
                echo ('ERROR: Empty value');
                die;
            }
        }
    }
    try {
        $sql_users_check = "SELECT * FROM user";
        $results_users = $connection->query($sql_users_check);
        foreach ($results_users as $item) {
            $password_db = ($item["users_password"]);
            $email_db = ($item["users_email"]);
            $username_db = ($item["users_name"]);
            $user_id = $item["users_id"];


            if (password_verify($password, $password_db) && $email === $email_db) {
                http_response_code(200);
                echo json_encode(array("message" => "Logged in.", "username" => $username_db, "id" => $user_id));
            } 
        }
    } catch (PDOException $e) {
        die("ERROR: Could not  execute "  . $e->getMessage());
    }
}
