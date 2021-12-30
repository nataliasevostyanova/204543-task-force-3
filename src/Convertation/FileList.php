<?php

namespace TaskForce\Convertation;

use FilesystemIterator;

/**
 * класс для получения списка csv-файлов в заданной директории
 */
class FileList extends \FilesystemIterator
{
    private string $directory = '../data/csv/';

    /**
     * массив имен директорий csv-файлов в заданной папке $directory
     * @param string $directory
     * @return array|null
     */
    public function getFileList(string $directory) : array
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
