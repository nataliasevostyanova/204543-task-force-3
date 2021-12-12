<?php

require_once '../vendor/autoload.php';


use TaskForce\Convertation\ConvertCSVtoSQL;

$convert = new ConvertCSVtoSQL('../data/csv/categories.csv', 'category');

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
print($convert->createSQLQuery('../data/csv/categories.csv', 'category'));
echo '</pre>';

