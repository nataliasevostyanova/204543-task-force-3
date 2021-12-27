<?php

namespace TaskForce\Convertation;

use \SplFileObject;
use \SplFileInfo;
use TaskForce\Exceptions\FileExistException;
use TaskForce\Exceptions\FileOpenException;

/**
 * класс для конвертации csv-файлов в sql-таблицы
 */
class Converter
{
    private string|null $filename;       // путь к csv-файлу
    private string|null $sqlTableName;   // имя sql-таблицы, куда нужно импортировать данные csv-файла
    private string $targetSql;              // имя файла sql для записи запроса
    private object $fileobject;                          // объект класса SplFileObject

    public function __construct(string $filename, string $sqlTableName, string $targetSql)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;
        $this->targetSql = $targetSql;
        $this->validCSV($filename);
        $this->fileobject = new SplFileObject($this->filename);
    }

    /**
     * Функция для проверки существования файла и возможности его открыть для чтения
     * @param string $filePath
     * @return void
     * @throws FileExistException
     * @throws FileOpenException
     */
    private function validCSV(string $filename): void
    {
        $this->fileobject = new SplFileObject($filename);

        if (!file_exists($this->filename)) {
            throw new FileExistException('Файл не найден в данной директории'); // exception needs try-catch in test
        }
        $this->fileobject = new SplFileObject($this->filename);

        $this->fp = fopen($this->filename, "rb");

        if (!$this->fp) {
            throw new FileOpenException('Не удалось открыть файл для чтения'); // exception needs try-catch in test
        }
    }

    /**
     * получает имена столбцов в виде одномерного массива
     * @param string $filename
     * @return array
     */
    public function getHeadersCSV(string $filename): array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $this->fileobject->rewind();
        return $this->fileobject->fgetcsv();
    }

    /**
     * получает имена столбцов в виде строки
     * @param string $filename
     * @return string
     */
    public function getHeadersLine(string $filename): string
    {
        $columnsLine = " (`" . implode("`, `", $this->getHeadersCSV($this->filename)) . "`) ";
        return $columnsLine;
    }

    /**
     * получает массив строк данных из файла *.csv
     * @param string $filename
     * @return array
     */
    public function getCSVData(string $filename): array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $result = [];

        while (!$this->fileobject->eof()) {
            $result[] =  implode("', '", $this->fileobject->fgetcsv());
        }
        $values = array_filter($result, function($a) {return $a !== "";});
        unset($values[0]);
        return $values;
    }

    /**
     * "Запись в sql-файл"
     * готовит sql-запросы на добавление данных из файла *.csv в sql-файл
     * @param string $filename
     * @param string $sqlTableName
     * @return string
     */
    public function getQueryToFile(string $filename, string $sqlTableName): string
    {
        $sqlLine = [];

        foreach ($this->getCSVData($filename) as $values) {
            $sqlLine[] = "INSERT INTO `" . $this->sqlTableName . "`" . $this->getHeadersLine($this->filename) . "\r\n" . "VALUES (". "'" . $values . "'". ");" . "\r\n";
        }
        return implode($sqlLine);
    }

    /**
     * записывает sql-запросы на добавление данных в sql-файл
     * @param string $filename
     * @param string $targetSql
     * @param string $sqlTableName
     * @return void
     */
    public function writeQuery(string $filename, string $sqlTableName, string $targetSql): void
    {
        $this->fileobject = new SplFileObject($this->filename, $this->sqlTableName, $this->targetSql);

        $sqlfile = fopen($this->targetSql, 'w');
        $sql = $this->getQueryToFile($this->filename, $this->sqlTableName);
        fwrite($sqlfile, $sql);
        fclose($this->targetSql);
    }
}



