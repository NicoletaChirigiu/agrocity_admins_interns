<?php
$router->define([
    '' => 'controllers/redirect/redirect.php',
    'register' => 'controllers/register/register.php',
    'login' => 'controllers/login/login.php',
    'create-charts' => 'controllers/getData/getData.php',
    'insertSkills' => 'controllers/insertData/insertData.php',
    // 'edit-task' => 'database/edit-task.php',
]);