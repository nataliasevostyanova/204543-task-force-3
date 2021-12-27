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
    private string $sqlTableName;   // имя sql-таблицы, куда нужно импортировать данные csv-файла
    //private array|string|null $columns = null;  // массив/строка имен столбцов/полей файла csv
    private array|null $values = null;          // массив данных полей файла csv
    public string $targetSql;// = '../data/insert_db.sql' имя файла sql для записи запроса
    private object $fileobject;                          // объект класса SplFileObject

    public function __construct(string $filename, string $sqlTableName)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;
        $this->validCSV($filename);
        $this->fileobject = new SplFileObject($this->filename);
        $this->fileobject->setCsvControl($separator = ",", $enclosure = "\"", $escape = "\\");
    }

    /**
     * Функция для проверки существования файла и возможности его открыть для чтения
     * @param string $filename
     * @return void
     * @throws FileExistException
     * @throws FileOpenException
     */
    private function validCSV(string $filename): void
    {
       if (!file_exists($this->filename)) {
            throw new FileExistException('Файл не найден в данной директории');
       }
       if (!fopen($this->filename, "rb")) {
           throw new FileOpenException('Не удалось открыть файл для чтения');
       }

    }

    /**
     * получает имена столбцов в виде одномерного массива
     * @param string $filename
     * @return array
     *
     */
    /*public function getHeadersCSV(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);
        //$columns = null;
        $this->fileobject->rewind();
        return $this->fileobject->fgetcsv();
       // return $columns;
    }*/
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
        return " (`". implode("`, `", $this->getHeadersCSV($this->fileobject)) . "`) ";
        //return $columnsLine;
    }

    /**
     * получает массив строк данных из файла *.csv
     * @param string $filename
     * @return array
     */
    public function getCSVData(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);
        $values = [];
        while (!$this->fileobject->eof()) {
            $values[] =  implode("','", $this->fileobject->fgetcsv()) ;
        }
        $values = array_filter($values, function($a) {return $a !== "";});
        return  $values;
    }




    /**
     * "Запись в sql-файл"
     * готовит sql-запросы на добавление данных из файла *.csv в sql-файл
     * @param string $filename
     * @param string $sqlTableName
     * @return string
     */
    /*public function getQueryToFile(string $sqlTableName) : string
    {
        $sqlLine = [];
        $values = $this->getCSVData($this->filename);

        foreach ($values as $value) {

           $sqlLine[] = "INSERT INTO `" . $sqlTableName . "`" .
               $this->getHeadersLine() ."\r\n"."VALUES ('" . $value . "');". "\r\n";
        }
        return implode(" ", $sqlLine);
    }*/

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
     * @param string $sqlTableName
     * @param string $targetSql
     * @return void
     */
    /*public function writeQuery(string $filename, string $sqlTableName, string $targetSql) : void
    {
        file_put_contents($this->targetSql, $this->getQueryToFile($this->targetSql, $this->sqlTableName));
    }*/

    public function writeQuery(string $filename, string $sqlTableName, string $targetSql) : void
    {
       // $targetSql = '../data/sql/opinions.sql';
        $sqlFile = fopen($targetSql, 'w') or die("Невозможно открыть файл");
        $sql = $this->getQueryToFile($this->filename, $this->sqlTableName);
        fwrite($sqlFile, $sql);
    }
}



