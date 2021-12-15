<?php

namespace TaskForce\Convertation;

use \SplFileInfo;
use \SplFileObject;

class ConvertCSV
{
    private string $filename;    // путь к файлу csv
    private array $columns;
    private array $values;

    private object $fileinfo;   // объект класса SplFileInfo
    private object $fileobject; // объект класса SplFileObject

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param string $filename
     * @return object
     */
    public function validFileCSV(string $filename) : object
    {
        $this->fileinfo = new SplFileInfo();

        if (!$this->fileInfo->isFile()) {
            throw new SourceFileException("Файл не существует");
        }

        if ($this->fileInfo->isReadable()) {
            throw new SourceFileException("Файл не читается");
        }
        if (!$this->fileobject instanceof \SplFileObject) {

            $this->fileobject = $this->fileinfo->openFile();
            $this->fileobject->setFlags(\SplFileObject::READ_CSV |\SplFileObject::DROP_NEW_LINE | \SplFileObject::SKIP_EMPTY );

        }
            return $this->fileobject;
    }
    /**
     * получает имена столбцов из файла csv
     * @param string $filename
     * @return array $columns
     */
    public function getHeadersCSV(string $filename) : array
    {
        $this->fileobject = new SplFileObject($this->filename);

        $this->fileobject->rewind();
        $this->columns = $this->fileobject->fgetcsv();

        return $this->columns;
    }

    /**
     * получает данные строк csv-файла
     * @param string $filename
     * @return array
     */
    public function getDataCSV($filename) : array
    {
        $result = [];
        foreach ($this->getNextLine($this->filename) as $line) {
            //$result[] = implode(", ", $line);
            $result[] = $line;
        }
        $this->values = array_filter($result);
        unset($this->values[0]);
        //$this->values = array_filter($this->values);
        return $this->values;
    }

    /**
     * @param  string $filename
     * @return iterable|null
     */
    private function getNextLine(string $filename) : ?iterable
    {
        $this->fileobject = new SplFileObject($filename);
        $result = NULL;

        while (!$this->fileobject->eof()) {
            yield $this->fileobject->fgetcsv();
        }
        return $result;
    }


    public function  getArrayData() : bool|array
    {
        $this->columns = $this->getHeadersCSV($this->filename);
        $this->values = $this->getDataCSV($this->filename);


        $dataToInsert = [];

        for($i = 0, $size = count($this->values); $i < $size; ++$i) {
            $people[$i]['salt'] = mt_rand(000000, 999999);
        }

        for($i = 1, $size = count($this->values); $i < $size; ++$i) {
            $dataToInsert[] = array_combine($this->columns, $this->values[$i]);
        }


        return $dataToInsert; // для конструкции for
    }

    /**
     * преобразуетдвумерный массив $values в одномерный
     * @return bool|array
     */

    public function  getValuesArray() : bool|array
    {
        $this->values = $this->getDataCSV($this->filename);
        $valuesToInsert =[];

        foreach ($this->values as $row => $data) {
           foreach($data as $val) {
              $valuesToInsert[] = $val;
            }
        }
        return array_filter($valuesToInsert); // одномерный массив данных для values;
    }

}
