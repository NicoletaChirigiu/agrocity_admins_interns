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

    if (!isset($data->users_name, $data->users_password, $data->users_team, $data->users_email)) {
        http_response_code(404);
        echo json_encode("ERROR: Parameters are not correct.");
        die;
    } else {
        $team = $data->users_team;
        $username = test_input($data->users_name);
        $password = password_hash(test_input($data->users_password), PASSWORD_DEFAULT);
        $email = test_input(($data->users_email));
        $description = test_input($data->users_description);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                echo json_encode(array('ERROR => Empty value'));
                http_response_code(404);
                die;
            }
        }
    }
    try {
        $sql_users_check = "SELECT * FROM user";
        $sql_team_check = "SELECT * FROM team";
        $results_users = $connection->query($sql_users_check);
        $results_team = $connection->query($sql_team_check);
        foreach ($results_users as $key => $value) {
            $email_adress = ($value["users_email"]);
            if ($email_adress == $email) {
                http_response_code(303);
                echo json_encode(array("ERROR:This email is used"));
                echo "ERROR:This email is used";
                die();
            }
        }
        $sql = "INSERT INTO user(users_name, users_password, users_team, users_email, users_description) 
            VALUES (?, ?, ?, ? ,?)";
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $password, PDO::PARAM_STR);
            $stmt->bindParam(3, $team, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $description, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            http_response_code(404);
            echo ("ERROR");
            die;
        }
        echo " Registered. ";
    } catch (PDOException $e) {
        die("ERROR: Could not  execute "  . $e->getMessage());
    }
}
