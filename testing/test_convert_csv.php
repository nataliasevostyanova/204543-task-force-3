<?php

require_once '../vendor/autoload.php';

use TaskForce\Convertation\FileList;
use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\Convertation\Converter;
use TaskForce\DBConnection;

$convert = new Converter('../data/csv/users.csv', 'users', '../data/sql/users.sql');

echo 'getHeadersCSV:';
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/users.csv'));
echo '</pre>';

echo 'getHeadersLine:';
echo '<pre>';
var_dump($convert->getHeadersLine('../data/csv/users.csv'));
echo '</pre>';

echo 'getCSVData():';
echo '<pre>';
var_dump($convert->getCSVData('../data/csv/users.csv'));
echo '</pre>';

echo 'sql-запрос для записи в файл:';
echo '<pre>';
var_dump($convert->getQueryToFile('../data/csv/users.csv','users'));
echo '</pre>';

echo '<pre>';
var_dump($convert->writeQuery('../data/csv/users.csv', 'users', '../data/sql/users.sql'));
echo '</pre>';
/*

$fsi = new FileList('C:/OpenServer/domains/localhost/TaskForce/data/csv/');

echo 'Список файлов csv в папке ../data/csv/';
echo '<pre>';
var_dump($fsi->getFileListing('C:/OpenServer/domains/localhost/TaskForce/data/csv/'));
echo '</pre>';
*/












