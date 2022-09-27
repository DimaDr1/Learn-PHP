<?php

include_once ROOT.'/models/news.php';

class NewsController {
    
    public function actionIndex(){
        //echo '<br> вызвали NewsController с методом actionIndex - просмотр всех новостей';
        
        $newsList = array();
        $newsList = NEWS::getNewsList(); //обращаемся к статическому методу getNewsList() модели News.php
                                    // получаем данные
        
       require_once (ROOT. '/views/news/indexN.php'); // подключаем файл отображения страницы
       // echo '<pre>';
       // print_r($newsList);
       //    echo '</pre>';
        return true;
    }
    
    public function actionView($id){
        
        if($id) {
            $newsItem = NEWS::getNewsItemById($id);
         //   echo '<pre>';
         //print_r($newsItem);
         //  echo '</pre>';
            require_once (ROOT. '/views/news/indexNView.php');
        }
        
        echo '<br>вызвали NewsController с методом actionView - просмотр одной новости';
        return true;
    }
    
}
