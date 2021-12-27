<?php

require_once '../vendor/autoload.php';

use TaskForce\Convertation\FileList;
use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\DBConnection;

$convert = new ConvertCSVtoSQL('../data/csv/categories.csv', 'categories');

echo 'getHeadersCSV:';
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/categories.csv'));
echo '</pre>';

echo 'getHeadersLine:';
echo '<pre>';
var_dump($convert->getHeadersLine('../data/csv/categories.csv'));
echo '</pre>';

echo 'getCSVData():';
echo '<pre>';
var_dump($convert->getCSVData('../data/csv/categories.csv'));
echo '</pre>';

echo 'sql-запрос для записи в файл:';
echo '<pre>';
var_dump($convert->getQueryToFile('../data/csv/categories.csv','categories'));
echo '</pre>';

echo '<pre>';
var_dump($convert->writeQuery('../data/csv/categories.csv','categories', 'categories.sql'));
echo '</pre>';
/*

$fsi = new FileList('C:/OpenServer/domains/localhost/TaskForce/data/csv/');

echo 'Список файлов csv в папке ../data/csv/';
echo '<pre>';
var_dump($fsi->getFileListing('C:/OpenServer/domains/localhost/TaskForce/data/csv/'));
echo '</pre>';
*/












