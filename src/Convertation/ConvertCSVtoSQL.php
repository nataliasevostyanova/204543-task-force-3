<?php
/**
 * класс для конвертации csv-файлов в sql-таблицы
 */
namespace TaskForce\Convertation;

use \SplFileObject;

class ConvertCSVtoSQL
{
    private string $filename = ''; //путь к csv-файлу
    private string $sqlTableName = 'category'; //имя sql-файла, куда нужно импортировать данные csv-файла
    private string $columns; //массив имен столбцов/полей файла csv
    private array $values = []; //  массив данных полей файла csv
    private object $fileobject;
    private string $dumpDB; //путь к sql-файлу базы данных

    public function __construct(string $filename, string $sqlTableName, string $dumpDB)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;
        $this->dumpDB = $dumpDB;
    }

    /**
     * Функция для проверки существования файла и возможности его открыть для чтения
     * @param string $filePath
     * @return void
     * @throws FileExistException
     * @throws FileOpenException
     */

    public function validCSV(string $filename): void
    {
       $this->fileobject = new SplFileObject($filename);
       // $this->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
       // $this->setCsvControl(",", '"', "\"");

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
     * можно убрать потом
     * @param string $filename
     * @return string
     */
    public function getHeadersCSV(string $filename) : string
    {
        $this->fileobject = new SplFileObject($this->filename);

        $this->fileobject->rewind();
        $this->columns = implode('`, `', $this->fileobject->fgetcsv());

        return $this->columns;
    }

    public function getCSVData($filename) {

        $this->fileobject = new SplFileObject($this->filename);
        // $this->fileobject->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        // setCsvControl(",", '"', "\"");

        $result = [];

        while (!$this->fileobject->eof()) {
            $result[] = implode("', '", $this->fileobject->fgetcsv());
        }
        $values = array_filter($result);
        unset($values[0]);
        return $values;
    }

     //   INSERT INTO `category`(`id`, `name`) VALUES ('[value-1]','[value-2]')

    public function createSQLQuery(string $filename, string $sqlTableName)
    {
        $sqlLine = [];
            //INSERT INTO `category` (`name`, `icon`) VALUES ('Курьерские услуги', 'delivary')
        foreach ($this->getCSVData($filename) as $values)
        {
           $sqlLine[] = "INSERT INTO `" . $this->sqlTableName . "` (`" . $this->columns . "`)"."\r\n"."VALUES ('" . $values . "');". "\r\n";
        }

       return implode($sqlLine);

    }

    public function writeQuery(string $dumpDB, string $filename)
    {
        file_put_contents($this->dumpDB, $this->createSQLQuery($filename, $this->sqlTableName), FILE_APPEND);
    }
}



