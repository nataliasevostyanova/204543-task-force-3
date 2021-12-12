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

       public function __construct(string $filename, string $sqlTableName)
    {
        $this->filename = $filename;
        $this->sqlTableName = $sqlTableName;
        //$this->$fileobject = new SplFileObject($filename);
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
        $this->fileobject = new SplFileObject($filename);

        $this->fileobject->rewind();
        $this->columns = implode(', ', $this->fileobject->fgetcsv());
        $this->fileobject->next();

        return $this->columns;
    }

    public function getCSVData($filename) {

        $this->fileobject = new SplFileObject($filename);
       // $this->fileobject->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        // setCsvControl(",", '"', "\"");

        $result = [];

        while (!$this->fileobject->eof()) {
            $result[] = implode(",", $this->fileobject->fgetcsv());
        }
        $values = array_filter($result);
        unset($values[0]);
        return $values;
    }
/*
        INSERT INTO table_name (column1, column2, column3, ...)
        VALUES (value1, value2, value3, ...);
        columns `id`, `name`
        values */

     //   INSERT INTO `category`(`id`, `name`) VALUES ('[value-1]','[value-2]')

    public function createSQLQuery(string $filename, string $sqlTableName)
    {
        $sqlLine = [];
        foreach ($this->getCSVData($filename) as $values)
        {
              $sqlLine[] = 'INSERT INTO `' . $this->sqlTableName . '`(' . $this->columns . ') VALUES (' . $values . ')';

        }
        return implode('<br>', $sqlLine);
    }

}
