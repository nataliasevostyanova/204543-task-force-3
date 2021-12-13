<?php

require_once '../vendor/autoload.php';


use TaskForce\Convertation\ConvertCSVtoSQL;
use TaskForce\Convertation\DBConnection;

$convert = new ConvertCSVtoSQL('../data/csv/categories.csv', 'category', '../data/db_taskforce.sql');

/*
echo '<pre>';
var_dump(implode(",", $this->convert->getCSVLines()));
echo '</pre>';
*/
echo '<pre>';
var_dump($convert->getHeadersCSV('../data/csv/categories.csv'));
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



