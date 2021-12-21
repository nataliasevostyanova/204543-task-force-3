<?php

namespace TaskForce;

use PDO;
use TaskForce\Convertation\ConvertCSVtoSQL;

/**
 * класс для соединения с базой данных  и обработки sql-запроса
 */
class DBConnection
{
    private string $host = 'localhost';
    private string $username = 'natasha';
    private string $password = 'natasha';
    private string $dbname = 'db_taskforce';
    private string $charset = 'utf8mb4';

    private object $pdo;
    private nullable|string|null $filename = null;
    private nullable|string|null $sqlTableName = null;

    public function __construct(string $filename, string $sqlTableName)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;
    }


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

        $this->pdo = new PDO($dsn, $username, $password, $opt);

        return $this->pdo;
    }

    /**
     * формирование запроса
     *
     */
    public function execQuery(string $filename, string $sqlTableName)
    {
        $convert = new ConvertCSVtoSQL($filename, $sqlTableName);
        $rowInsert = $convert->getPrepQuery($this->filename, $this->sqlTableName);

        $stmt = $this->pdo->prepare($rowInsert);
        $csvData =  $convert->getCSVData($this->filename) ;

        foreach ($csvData as $key => $data) {
           $stmt = $this->pdo->exec($data);
        }


    }



}

