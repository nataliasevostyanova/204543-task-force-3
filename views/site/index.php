<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$title = 'TaskForce';
$content = 'Hello, world!';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../../web/css/style.css">
</head>
<body>


<header>
    <nav class="main-nav">
    <a href='#' class="header-logo">
        <img class="logo-image" src="../../web/img/logotype.png" width=227 height=60 alt="taskforce">
    </a>
    <div class="nav-wrapper">
        <ul class="nav-list">
            <li class="list-item list-item--active">
                <a class="link link--nav" >Новое</a>
            </li>
            <li class="list-item">
                <a href="#" class="link link--nav" >Мои задания</a>
            </li>
            <li class="list-item">
                <a href="#" class="link link--nav" >Создать задание</a>
            </li>
            <li class="list-item">
                <a href="#" class="link link--nav" >Настройки</a>
            </li>
        </ul>
    </div>
    </nav>
    <div class="user-block">
        <a href="#">
            <img class="user-photo" src="../../web/img/man-glasses.png" width="55" height="55" alt="Аватар">
        </a>
        <div class="user-menu">
            <p class="user-name">Василий</p>
            <div class="popup-head">
                <ul class="popup-menu">
                    <li class="menu-item">
                        <a href="#" class="link">Настройки</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="link">Связаться с нами</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="link">Выход из системы</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
 </header>

<main role="main" class="flex-shrink-0">
    <div class="main-content">
        <?= $content ?>
    </div>
</main>

</body>
</html>

