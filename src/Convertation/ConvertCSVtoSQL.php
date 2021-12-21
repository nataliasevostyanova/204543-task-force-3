<?php
/**
 * класс для конвертации csv-файлов в sql-таблицы
 */
namespace TaskForce\Convertation;

use \SplFileObject;
use \SplFileInfo;
use TaskForce\Exceptions\FileExistException;
use TaskForce\Exceptions\FileOpenException;


class ConvertCSVtoSQL
{
    private nullable|string|null $filename = null;       // путь к csv-файлу
    private nullable|string|null $sqlTableName = null;   // имя sql-таблицы, куда нужно импортировать данные csv-файла
    private nullable|array|string|null $columns = null;  // массив/строка имен столбцов/полей файла csv
    private nullable|array|null $values = null;          // массив данных полей файла csv
    private nullable|string|null$targetSql;              // имя файла sql для записи запроса
    private object $fileobject;                          // объект класса SplFileObject

    public function __construct(string $filename, string $sqlTableName)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;

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
    public function getHeadersCSV(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $this->fileobject->rewind();
        $this->columns = $this->fileobject->fgetcsv();
        return $this->columns;
    }

    /**
     * получает имена столбцов в виде строки
     * @param string $filename
     * @return string
     */
    public function getHeadersLine(string $filename) : string
    {
        $columnsLine = " (`". implode("`, `", $this->getHeadersCSV($this->filename)) . "`) ";
        return $columnsLine;
    }

    /**
     * получает массив строк данных из файла *.csv
     * @param string $filename
     * @return array
     */
    public function getCSVData(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $result = [];

        while (!$this->fileobject->eof()) {
            $result[] = "'". implode("', '", $this->fileobject->fgetcsv()). "'";
        }
        $values = array_filter($result);
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
    public function getQueryToFile(string $filename, string $sqlTableName) : string
    {
        $sqlLine = [];
        $this->columns = $this->getHeadersLine($this->filename);
        $this->values = $this->getCSVData($this->filename);

        foreach ($this->getCSVData($filename) as $values)
        {
            $sqlLine[] = "INSERT INTO `" . $this->sqlTableName . "`" . $this->columns ."\r\n"."VALUES (" . $values . ");". "\r\n";
        }
        return implode($sqlLine);
    }

    /**
     * готовит sql-запросы для подготовленного выражения с плейсхолдерами
     * @param string $filename
     * @param string $sqlTableName
     * @return string
     */
    public function getPrepQuery(string $filename, string $sqlTableName) : string
    {
        $count = count($this->getHeadersCSV($this->filename));
        $questions = str_repeat("?,", $count);
        $questions = substr($questions, 0, -1);

        $sqlLine = "INSERT INTO `" . $this->sqlTableName . "` " . $this->getHeadersLine($this->filename) . " VALUES (" . $questions . ")";
        return $sqlLine;
    }


    /**
     * записывает sql-запросы на добавление данных в sql-файл
     * @param string $filename
     * @param string $targetSql
     * @param string $sqlTableName
     * @return void
     */
    public function writeQuery(string $filename, string $targetSql, string $sqlTableName) : void
    {
        $this->fileobject = new SplFileObject($this->filename, $this->sqlTableName);
        $this->targetSql = $targetSql;
        $sqlfile = fopen($this->targetSql, 'w');
        $sql = $this->getQueryToFile($this->filename, $this->sqlTableName);
        fwrite($sqlfile, $sql);
        fclose($this->targetSql);
    }
}



