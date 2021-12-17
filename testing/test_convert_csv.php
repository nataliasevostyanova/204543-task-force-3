<?php

require_once '../vendor/autoload.php';


use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\Convertation\ConvertCSV;
use TaskForce\DBConnection;

$convert = new ConvertCSVtoSQL('../data/csv/categories.csv', 'category');

echo 'getHeadersCSV';
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/categories.csv'));
echo '</pre>';

echo '<pre>';
var_dump($convert->getHeadersLine('../data/csv/categories.csv'));
echo '</pre>';

echo '<pre>';
var_dump(count($convert->getHeadersCSV('../data/csv/categories.csv')));
echo '</pre>';


echo 'getCSVData()';
echo '<pre>';
var_dump($convert->getCSVData('../data/csv/categories.csv'));
echo '</pre>';


echo 'sql-запрос для записи в dump:';
echo '<pre>';
var_dump($convert->getQueryToDump('../data/csv/categories.csv','category'));
echo '</pre>';
/*
echo '<pre>';
var_dump($convert->writeQuery('../data/db_taskforce.sql', '../data/csv/categories.csv', 'category'));
echo '</pre>';

$convert1 = new ConvertCSV('../data/csv/categories.csv','category');

echo '<pre>';
print_r($convert1->getDataCSV('../data/csv/categories.csv')); //многомерный массив values
echo '</pre>';

echo '<pre>';
print_r($convert1->getValuesLines('../data/csv/categories.csv')); // одномерный массив строк values
echo '</pre>';

echo '<pre>';
print_r($convert1->getHeadersCSV('../data/csv/categories.csv')); // массив columns
echo '</pre>';

echo '<pre>';
print_r($convert1->getHeadersLine('../data/csv/categories.csv')); // строка columns
echo '</pre>';

echo '<pre>';
var_dump($convert1->getArrayData());
echo '</pre>';

echo '<pre>';
var_dump($convert1->getValuesArray());
echo '</pre>';

echo '<pre>';
var_dump($convert1->createSQLQuery('../data/csv/categories.csv','category'));
echo '</pre>';
*/

$link = new DBConnection('localhost', 'natasha', 'natasha', 'db_taskforce', 'utf-8' );
echo '<pre>';
var_dump($link->connectDB('localhost', 'natasha', 'natasha', 'db_taskforce', 'utf-8' ));
echo '</pre>';

echo '<pre>';
var_dump($link->getQuery('../data/csv/categories.csv', 'category', '../data/db_taskforce.sql'));
echo '</pre>';

echo '<pre>';
var_dump($link->execQuery('../data/csv/categories.csv', 'category', '../data/db_taskforce.sql'));
echo '</pre>';








