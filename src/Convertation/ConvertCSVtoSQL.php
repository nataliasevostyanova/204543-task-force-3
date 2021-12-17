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
    private string $filename;       // путь к csv-файлу
    private string $sqlTableName;   // имя sql-файла, куда нужно импортировать данные csv-файла
    private string|array $columns;  // массив/строка имен столбцов/полей файла csv
    private array $values;          // массив данных полей файла csv
    private object $fileobject;     // объект класса SplFileObject
    private string $dumpDB; // путь к sql-файлу базы данных

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
     * получает массив данных из файла *.csv для заполнения строк в sql-таблице
     * @param string $filename
     * @return array
     */
    public function getCSVData(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $result = [];

        while (!$this->fileobject->eof()) {

            $result[] = implode("', '", $this->fileobject->fgetcsv());
        }
        $values = array_filter($result);
        unset($values[0]);
        return $values;
    }

        /**
         * готовит sql-запросы на добавление данных из файда *.csv в sql-таблицу
         * createSQLQuery == getQueryToDump
         * @param string $filename
         * @param string $sqlTableName
         * @return string
         */
        public function getQueryToDump(string $filename, string $sqlTableName) : string
        {
            $this->filename =  '../data/csv/categories.csv';
            $sqlLine = [];
            $this->columns = $this->getHeadersLine($this->filename);
            $this->values = $this->getCSVData($this->filename);

            foreach ($this->getCSVData($filename) as $values)
            {
                $sqlLine[] = "INSERT INTO `" . $this->sqlTableName . "`" . $this->columns ."\r\n"."VALUES ('" . $values . "');". "\r\n";
            }
        // вариант с подготовленным выражением
        //insert into table (fielda, fieldb, ... ) values (?,?...), (?,?...);

        return implode($sqlLine);
    }

    public function getPrepQuery(string $filename) : string
    {
        //$this->columns = $this->getHeadersLine($this->filename);
        $count = count($this->getHeadersCSV($this->filename));
        $questions = str_repeat("?,", $count);
        //substr("abcdef", 0, -1);
        $questions = substr($questions, 0, -1);

        $sqlLine = "INSERT INTO `" . $this->sqlTableName . "` " . $this->getHeadersLine($this->filename) . " VALUES (" . $questions . ")";
        return $sqlLine;
    }

    /**
     * записывает sql-запросы на добавление данных в файл базы данных
     * @param string $dumpDB
     * @param string $sqlTableName
     * @return int
     */
    public function writeQuery(string $dumpDB, string $sqlTableName) : int
    {
        $this->dumpDB = '../data/db_taskforce.sql';
        $this->sqlTableName = 'category';
        file_put_contents($this->dumpDB, $this->getQueryToDump($this->dumpDB, $this->sqlTableName), FILE_APPEND | LOCK_EX);
    }
}



