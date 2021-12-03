<?php

require_once '../vendor/autoload.php';

use TaskForce\Task;
use TaskForce\Exceptions\WrongActionException;
use TaskForce\Exceptions\WrongStatusException;

/**
 * проверяем исключение, выброшенное Task->getActualStatus() при валидации $action
 */
$task1 = new Task(5,5,3,'новое');
$errors1 = [];
     try {

        $task1->getActualStatus('отключить');

    } catch(WrongActionException $e) {

       $errors1 = $e->getMessage();
    }
/**
 * проверяем исключение, выброшенное в Task->getAllowedAction() при валидации $status
 */
$task2 = new Task(4, 4, 7, 'просроченное');
$errors2 = [];
try {

        $task2->getAllowedAction(4, 4, 7, 'просроченное');

    }   catch(WrongStatusException $e) {

        $errors2 = $e->getMessage();

        }

echo '<pre> Ошибки статуса: ';
var_dump($errors1);
echo '</pre>';
echo '<pre> Ошибки действий: ';
var_dump($errors2);
echo '</pre>';


  

