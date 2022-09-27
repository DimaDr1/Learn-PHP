<?php
// НАШ ФАЙЛ КОНТРОЛЛЕРА (включить mod-rewrite в настройках сервера через этот файл проходят все запросы,
//  основываяь на инструкциях, контроллер сам определяет какой файл будет обрабатыать запрос.)
//RewriteEngine on  разрешаем перенаправление
//RewriteBase /test1/ 
//RewriteRule ^(.*)$ index.php    - все запросы нужно направлять на файл index.php
//
//
//1. Общие настройки

    // Включаем отображение ошибок на время разработки сайта
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

//2. Подключаем файлы системы 

    define ('ROOT', dirname(__FILE__)); // через ф-ю define записываем в ROOT текущую директорию
    require_once (ROOT. '/components/Router.php'); // подключаем файл 
    require_once (ROOT. '/components/Db.php');
//3. Установка соединения с БД
    
    
//4. Вызов  Router.php
    
    $router = new Router(); // создадим экземпляр(объект) класса Router(Router.php)
    $router -> run(); // вызовем метод run(); (Router.php)
    
    
    

    
    