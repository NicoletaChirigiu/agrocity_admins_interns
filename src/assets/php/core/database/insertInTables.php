<?php

class Insert
{
    public static function teams($connection)
    {

        try {
            $sql = "INSERT INTO team (team_name) 
        SELECT * FROM (SELECT 'team1') AS tmp
     WHERE NOT EXISTS
      (SELECT team_name FROM team
     WHERE team_name = team1)";
            $connection->exec($sql);
            echo "Records teams updated successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute. " . $e->getMessage());
        }
    }

    public static function skills($connection)
    {

        try {
            $sql = "INSERT INTO skills (name,type ) 
      VALUES
      ('comunicare', 'softSkill'),
      ('spiritDeEchipa', 'softSkill'),
      ('organizare', 'softSkill'),
      ('flexibilitate', 'softSkill'),
      ('creativitate', 'softSkill'),
      ('proactivitate', 'softSkill'),
      ('gandireLogica', 'softSkill'),
      ('punctualitate', 'softSkill'),
      ('html', 'hardSkill'),
      ('css', 'hardSkill'),
      ('scss', 'hardSkill'),
      ('tailwind', 'hardSkill'),
      ('js', 'hardSkill'),
      ('vue', 'hardSkill'),
      ('php', 'hardSkill'),
      ('laravel', 'hardSkill')
      ";
            $connection->exec($sql);
            echo "Records skills updated successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not execute. " . $e->getMessage());
        }
    }

}
