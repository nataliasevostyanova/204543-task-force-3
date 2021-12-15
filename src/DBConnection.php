<?php

namespace TaskForce;

use PDO;
use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\Convertation\ConvertCSV;

class DBConnection
{
    private string $host = 'localhost';
    private string $username = 'natasha';
    private string $password = 'natasha';
    private string $dbname = 'db_taskforce';
    private string $charset = 'utf8';

    private object $pdo;
    private string $sqlTableName;

    /** Соединение с БД
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @return object|null
     */
    public function connectDB(string $host, string $username, string $password, string $dbname, string $charset) : ?object
    {
        $dsn = "mysql:host=$host; dbname=$dbname; charset=$charset";
        $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => true,
        ];

        $this->pdo = new PDO($dsn, $username, $password, $opt);

        return $this->pdo;
    }




    // Операции c БД
    /*public function query(string $filename, string $sqlTableName, string $dumpDB)
    {
        $data = new ConvertCSVtoSQL(string $filename, string $sqlTableName, string $dumpDB)

        $insert_id = [];

        foreach($data->createSQLQuery($filename, $sqlTableName) as $values) {

            $this->db->exec($query);
            $insert_id[] = $this->db->lastInsertId();
        }
        return $insert_id;
    }*/

}

