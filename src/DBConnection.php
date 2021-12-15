<?php

namespace TaskForce\Convertation;

use PDO;
use TaskForce\Convertation\ConvertCSVtoSQL;

class DBConnection
{
    private string $host = 'localhost';
    private string $username = 'natasha';
    private string $password = 'natasha';
    private string $dbname = 'db_taskforce';
    private string $charset = 'utf8';

    private object $db;
    private string $sqlTableName;

    /** Соединение с БД
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @return bool
     */
    public function connectDB(string $host, string $username, string $password, string $dbname, $charset) : bool
    {
        $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
        $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   = true,
        ];
        $pdo = new PDO($dsn, $username, $password, $opt);
    }

    /** Соединение с БД
     *
     */



    // Операции c БД
    public function query(string $filename, string $sqlTableName, string $dumpDB)
    {
        $data = new ConvertCSVtoSQL(string $filename, string $sqlTableName, string $dumpDB)

        $insert_id = [];

        foreach($data->createSQLQuery($filename, $sqlTableName) as $values) {
            $query = $this->db->quote($values);
            $this->db->exec($query);
            $insert_id[] = $db->lastInsertId();
        }
        return $insert_id;
    }

}

