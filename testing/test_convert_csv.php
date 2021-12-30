<?php

require_once '../vendor/autoload.php';

use TaskForce\Convertation\Converter;
use TaskForce\Convertation\FileList;

/**
 * Проверка класса FileList
 */
$flist = new FileList('C:/OpenServer/domains/localhost/TaskForce/data/csv/');

echo 'Список файлов csv в папке ../data/csv/';
echo '<pre>';
var_dump($flist->getFileList('C:/OpenServer/domains/localhost/TaskForce/data/csv/'));
echo '</pre>';


/**
 * Проверка класса Converter
 */
$convert = new Converter('../data/csv/tasks.csv', 'tasks', '../data/sql/tasks.sql');

echo 'getHeadersCSV:';
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/tasks.csv'));
echo '</pre>';

echo 'getHeadersLine:';
echo '<pre>';
var_dump($convert->getHeadersLine('../data/csv/tasks.csv'));
echo '</pre>';

echo 'getCSVData():';
echo '<pre>';
var_dump($convert->getCSVData('../data/csv/tasks.csv'));
echo '</pre>';

echo 'sql-запрос для записи в файл:';
echo '<pre>';
var_dump($convert->getQueryToFile('../data/csv/tasks.csv','tasks'));
echo '</pre>';

echo '<pre>';
var_dump($convert->writeQuery('../data/csv/tasks.csv', 'tasks', '../data/sql/tasks.sql'));
echo '</pre>';
















