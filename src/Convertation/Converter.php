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
    private string|null $csvPath;       // путь к csv-файлу
    private string|null $sqlTableName;   // имя sql-таблицы, куда нужно импортировать данные csv-файла
    private string $targetSql;           // имя файла sql для записи запроса
    private SplFileObject $fileobject;   // объект класса SplFileObject

    public function __construct(string $csvPath, string $sqlTableName, string $targetSql)
    {
        $this->csvPath = $csvPath;
        $this->sqlTableName = $sqlTableName;
        $this->targetSql = $targetSql;
        $this->validCSV($csvPath);
        $this->fileobject = new SplFileObject($this->csvPath);
    }

    /**
     * Функция для проверки существования файла и возможности его открыть для чтения
     * @param string $filePath
     * @return void
     * @throws FileExistException
     * @throws FileOpenException
     */
    private function validCSV(string $csvPath): void
    {
        $this->fileobject = new SplFileObject($csvPath);

        if (!file_exists($this->csvPath)) {
            throw new FileExistException('Файл не найден в данной директории'); // exception needs try-catch in test
        }
        $this->fileobject = new SplFileObject($this->csvPath);

        $fp = fopen($this->csvPath, "rb");

        if (!$fp) {
            throw new FileOpenException('Не удалось открыть файл для чтения'); // exception needs try-catch in test
        }
    }

    /**
     * получает имена столбцов в виде одномерного массива
     * @param string $csvPath
     * @return array
     */
    public function getHeadersCSV(string $csvPath): array
    {
        $this->fileobject = new SplFileObject($this->csvPath);
        $this->fileobject->rewind();
        return $this->fileobject->fgetcsv();
    }

    /**
     * получает имена столбцов в виде строки
     * @param string $csvPath
     * @return string
     */
    public function getHeadersLine(string $csvPath): string
    {
        return " (`" . implode("`, `", $this->getHeadersCSV($this->csvPath)) . "`) ";
    }

    /**
     * получает массив строк данных из файла *.csv
     * @param string $csvPath
     * @return array
     */
    public function getCSVData(string $csvPath): array
    {
        $this->fileobject = new SplFileObject($this->csvPath);
        $result = [];

        while (!$this->fileobject->eof()) {
            $result[] =  implode("\', \'", $this->fileobject->fgetcsv());
        }
        $values = array_filter($result, function($a) {return $a !== "";});
        unset($values[0]);
        return $values;
    }

    /**
     * "Запись в sql-файл"
     * готовит sql-запросы на добавление данных из файла *.csv в sql-файл
     * @param string $csvPath
     * @param string $sqlTableName
     * @return string
     */
    public function getQueryToFile(string $csvPath, string $sqlTableName): string
    {
        $sqlLine = [];

        foreach ($this->getCSVData($csvPath) as $values) {
            $sqlLine[] = "INSERT INTO `" . $this->sqlTableName . "`" . $this->getHeadersLine($this->csvPath) . "\r\n" . "VALUES (". "\'" . $values . "\'". ");" . "\r\n";
        }
        return implode($sqlLine);
    }

    /**
     * записывает sql-запросы на добавление данных в sql-файл
     * @param string $csvPath
     * @param string $targetSql
     * @param string $sqlTableName
     * @return void
     */
    public function writeQuery(string $csvPath, string $sqlTableName, string $targetSql): void
    {
        $this->fileobject = new SplFileObject($this->csvPath, $this->sqlTableName, $this->targetSql);
        $sqlfile = fopen($this->targetSql, 'w+');
        $sql = $this->getQueryToFile($this->csvPath, $this->sqlTableName);
        fwrite($sqlfile, $sql);
        fclose($this->targetSql);
    }
}



