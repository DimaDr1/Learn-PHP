<?php

class Db {
     
    public static function getConnection() {

       $paramsPath = ROOT. '/components/db_params.php';
       $params = include ($paramsPath);
        
       $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
       
       $db = new PDO($dsn, $params['user'], $params['password']); 
       return $db;
        //создадим объект класса PDO, передав параметры соединения
        // при помощи этого объекта мы будем общаться с БД
        // $host = 'localhost';  // это все параметры соединения
        //$dbname = 'base_news';
        //$user = 'root';
        //$password = '';
        //$dsn = "mysql:host=$host;dbname=$dbname";
        //$db = new PDO($dsn, $user, $password);
        
}
    
}
