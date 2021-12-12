<?php

namespace TaskForce\Convertation;

class DBConnection
{
    private string $host = 'localhost';
    private string $username = 'root';
    private string $passwd = '';
    private string $dbname = 'db_taskforce';
    private string $charset = 'utf8mb4_unicode_ci';

    private function __construct(string $host, string $username, string $passwd, string $dbname, string $charset))
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->passwd = '';
        $this->dbname = 'db_taskforce';
        $this->charset = 'utf8mb4_unicode_ci';
    }

    public function connectDB()
    {
        $link = mysqli::connect(string $host, string $username, string $passwd, string $dbname);
    mysqli::set_charset('UTF8') : bool;

        if (!$link) {
            throw new DdConnectException('Ошибка подключения: ' . $mysqli->connect_error);
        }
    }
}


