<?php


abstract class QueryBuilderTable
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    abstract public function createTable();
}



class TeamTable extends QueryBuilderTable
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS team(
            team_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            team_name VARCHAR(30)  NULL
         )";
        $this->pdo->exec($sql);
    }
}



class GradesTable extends QueryBuilderTable
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS grades (
        grade_id     INT AUTO_INCREMENT  PRIMARY KEY,
        week         INT                 DEFAULT NULL,
        grade         int        DEFAULT NULL,
        users_id      INT                 DEFAULT NULL,
        skill_id      int default null,
        foreign key (users_id) references user(users_id),
        foreign key (skill_id) references skills(skill_id)

    )";

        $this->pdo->exec($sql);
    }
}

class UsersTable extends QueryBuilderTable
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS user (
        users_id     INT AUTO_INCREMENT  PRIMARY KEY,
        users_password    VARCHAR (500)        DEFAULT NULL,
        users_name        VARCHAR (50)        DEFAULT NULL,
        users_email        VARCHAR (50)        DEFAULT NULL,
        users_team     VARCHAR (50)        DEFAULT NULL,
        users_description VARCHAR (400)       DEFAULT NULL,
        team_id     INT                 DEFAULT NULL,
        foreign key (team_id) references team(team_id)

    )";
        return $this->pdo->exec($sql);
    }
}



class SkillsTable extends QueryBuilderTable
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS skills (
            skill_id     INT AUTO_INCREMENT  PRIMARY KEY,
            name         VARCHAR (50)        DEFAULT NULL,
            type         VARCHAR (50)        DEFAULT NULL
        )";

        return $this->pdo->exec($sql);
    }
}

class AllUsersTable extends QueryBuilderTable
{
    public function createTable()
    {
        $sql = "        CREATE TABLE IF NOT EXISTS charts_users_tables (
            all_users_id     INT AUTO_INCREMENT  PRIMARY KEY,
            users_name    VARCHAR (50)      DEFAULT NULL,
            teams         VARCHAR (50)      DEFAULT NULL,
            weeks         VARCHAR (50)      DEFAULT NULL,
            skill_type         VARCHAR (50)      DEFAULT NULL,
            skills        VARCHAR (50)      DEFAULT NULL,
            grade         VARCHAR (50)      DEFAULT NULL,
            users_id      int               not null,
            foreign key (users_id) references user(users_id)
        )";

        return $this->pdo->exec($sql);
    }
}
