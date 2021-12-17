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
    private string $charset = 'utf8mb4';

    private object $db;
    private string $sqlTableName;
    private string $filename;

    /** Соединение с БД
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $dbname
     * @param string $charset
     * @return object|null
     */
    public function connectDB(string $host, string $username, string $password, string $dbname, string $charset): ?object
    {
        $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8mb4";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
        ];

        $this->db = new PDO($dsn, $username, $password, $opt);

        return $this->db;
    }
    /**
     * формирование запроса
     *
     */
    public function getQuery(string $filename, string $sqlTableName) : string|array
    {
        $this->filename = '../data/csv/categories.csv';
        $this->sqlTableName = 'category';

        $conv = new ConvertCSVtoSQL($this->filename, $this->sqlTableName);

        $sql = $conv->getPrepQuery($this->filename, $this->sqlTableName);

        $lineToInsert = explode(';', $sql);
        return $lineToInsert;
    }

    public function execQuery(string $filename, string $sqlTableName)
    {
        $this->filename = '../data/csv/categories.csv';
        $this->sqlTableName = 'category';
        $lines = $this->getQuery($this->filename, $this->sqlTableName);
        $rowInsert = [];

        foreach ($lines as $key => $line) {
            $rowInsert[] = $lines;
        }
          // запрос долже быть подготовленным!!!! иначе prepare() применять нельзя
        if (!empty($lines)) {
            throw new \PDOException("'Запрос к таблице ' . $this->sqlTableName . 'пуст'");
        }
        $stmt = $this->pdo->prepare($rowInsert);
        $stmt = $pdo->execute();
    }

    // Операции c БД


}

