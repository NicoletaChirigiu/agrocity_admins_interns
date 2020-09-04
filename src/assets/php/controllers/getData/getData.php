<?php
// try {
//     $sql = "SELECT * from user, team 
//      where users_team = team_name ";
//     $result = $connection->query($sql);
//     $tasks = array();
//     if ($result->rowCount() > 0) {
//         foreach ($result as $key => $value) {
//             var_dump($value);
//             http_response_code(200);
//         }
//         echo json_encode($tasks);
//     } else {
//         http_response_code(404);
//         echo json_encode(array("message" => "something is wrong"));
//         die();
//     }
// } catch (\Throwable $th) {
//     throw $th;
// }

try {
    $sql = "SELECT * from user u join skills s on (u.users_id = s.skill_id)";
       $result = $connection->query($sql);
           if ($result->rowCount() > 0) {
               foreach ($result as $key => $value) {
                   var_dump($value);
                   http_response_code(200);
               }
           } else {
               http_response_code(404);
               echo json_encode(array("message" => "something is wrong"));
               die();
           }
} catch (\Throwable $th) {
    throw $th;
}


// $sql = "SELECT s.name g.grade from user u join grades g on (u.user_id = g.user_id) 
// join skills s on (g.skill_id = s.skill_id) where u.user_id= 'users_name and g.week=4;";