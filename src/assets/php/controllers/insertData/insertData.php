<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $grade = $data->grade;
        $week = $data->week;
        $user_id = $data->users_id;
        $skill_id = $data->skill_id;

        if (!isset($grade,$week,$user_id,$skill_id)) {
            http_response_code(404);
            echo json_encode(array("ERROR: Parameters are not correct."));
            die;
        } else {
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    http_response_code(404);
                    echo ('ERROR: Empty value');
                    die;
                }
            }
        }
  
        try {
            $sql = "INSERT INTO grades(week, grade, users_id, skill_id) 
        VALUES (?, ?, ?, ?)";
            if ($stmt = $connection->prepare($sql)) {
                $stmt->bindParam(1, $week, PDO::PARAM_STR);
                $stmt->bindParam(2, $grade, PDO::PARAM_STR);
                $stmt->bindParam(3, $user_id, PDO::PARAM_STR);
                $stmt->bindParam(4, $skill_id, PDO::PARAM_STR);
                $stmt->execute();
                echo json_encode("Succes");
            } else {
                http_response_code(404);
                echo ("ERROR");
                die;
            }
        } catch (PDOException $e) {
            die("ERROR: Could not execute. " . $e->getMessage());
        }
    }

