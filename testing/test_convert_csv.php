<?php

require_once '../vendor/autoload.php';


use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\Convertation\ConvertCSV;
use TaskForce\DBConnection;

$convert = new ConvertCSVtoSQL('../data/csv/categories.csv', 'category', '../data/db_taskforce.sql');

/*
echo '<pre>';
var_dump(implode(",", $this->convert->getCSVLines()));
echo '</pre>';
*/
/*
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/categories.csv', 'category', '../data/db_taskforce.sql'));
echo '</pre>';

echo '<pre>';
var_dump($convert->getCSVData('../data/csv/categories.csv'));
echo '</pre>';

echo '<pre>';
var_dump($convert->createSQLQuery('../data/csv/categories.csv','category'));
echo '</pre>';

echo '<pre>';
var_dump($convert->writeQuery('../data/db_taskforce.sql', '../data/csv/categories.csv', 'category'));
echo '</pre>';
*/
$convert1 = new ConvertCSV('../data/csv/categories.csv');

echo '<pre>';
print_r($convert1->getDataCSV('../data/csv/categories.csv'));
echo '</pre>';

echo '<pre>';
print_r($convert1->getHeadersCSV('../data/csv/categories.csv'));
echo '</pre>';

echo '<pre>';
var_dump($convert1->getArrayData());
echo '</pre>';
/*
$link = new DBConnection();
echo '<pre>';
var_dump($link->connectDB('localhost', 'natasha', 'natasha', 'db_taskforce', 'utf-8' ));
echo '</pre>';
*/
