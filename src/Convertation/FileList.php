<?php

namespace TaskForce\Convertation;

use FilesystemIterator;

/**
 * класс для получения списка csv-файлов в заданной директории
 */
class FileList extends \FilesystemIterator
{
    private string $directory = '../data/csv/'; //папка с файлами
    private nullable|array|null $fileList = null;    // список файлов в папке

    public function __construct(string $directory, int $flags = FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::SKIP_DOTS)
    {
        parent::__construct($directory, $flags);
    }


    /**
     * массив имен директорий csv-файлов в заданной папке $directory
     * @param string $directory
     * @return array|null
     */
    public function getFileListing(string $directory) : ?array
    {
        $dir = new \DirectoryIterator($this->directory);

        $result = [];
        foreach ($dir as $fileinfo) {
            if ($dir->getExtension() === 'csv') {
                $result[] = str_replace('\\', '/', $fileinfo->getPathName());
            }
        }
        return $result;
    }

}
