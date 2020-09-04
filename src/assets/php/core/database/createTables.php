<?php

class Create
{

    public static function tables($connection)
    {
        try {
            $teamTable =  new TeamTable($connection);
            $teamTable->createTable();

            $usersTable =  new UsersTable($connection);
            $usersTable->createTable();

            $skillsTable =  new SkillsTable($connection);
            $skillsTable->createTable();

            $gradesTable =  new GradesTable($connection);
            $gradesTable->createTable();

            $allUsersTable =  new AllUsersTable($connection);
            $allUsersTable->createTable();
        } catch (PDOException $e) {
            die("ERROR: Could not execute. " . $e->getMessage());
        }
    }
}
