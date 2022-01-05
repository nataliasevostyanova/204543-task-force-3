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
$convert = new Converter('../data/csv/opninions.csv', 'opninions', '../data/sql/opninions.sql');

echo 'getHeadersCSV:';
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/opninions.csv'));
echo '</pre>';

echo 'getHeadersLine:';
echo '<pre>';
var_dump($convert->getHeadersLine('../data/csv/opninions.csv'));
echo '</pre>';

echo 'getCSVData():';
echo '<pre>';
var_dump($convert->getCSVData('../data/csv/opninions.csv'));
echo '</pre>';

echo 'sql-запрос для записи в файл:';
echo '<pre>';
var_dump($convert->getQueryToFile('../data/csv/opninions.csv','opninions'));
echo '</pre>';

echo '<pre>';
var_dump($convert->writeQuery('../data/csv/opninions.csv', 'opninions', '../data/sql/opninions.sql'));
echo '</pre>';


















