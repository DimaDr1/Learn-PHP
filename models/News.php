<?php


class News {
    public static function getNewsItemById($id) { //метод возвращает одну новость по $id
        
        $id = intval($id);
        
        if($id){
           // $host = 'localhost';
           // $dbname = 'base_news';
           // $user = 'root';
           // $password = '';
           // $dsn = "mysql:host=$host;dbname=$dbname";
           // $db = new PDO($dsn, $user, $password);
            
            $db=Db::getConnection(); 
            
            $result = $db->query('SELECT * FROM test_news WHERE id='.$id);
            
            //$result -> setFetchMode(PDO::FETCH_NUM);// индексы в виде номеров колонок
            $result -> setFetchMode(PDO::FETCH_ASSOC); // индексы в виде названий
            
            $newsItem = $result->fetch();
            return $newsItem;
        }
    }
    
    public static function getNewsList() { // метод возвращает список новостей
        //пишем код с помощью которого получим данные из базы
        
      //  $host = 'localhost';  // это все параметры соединения
       // $dbname = 'base_news';
       // $user = 'root';
       // $password = '';
        
        //создадим объект класса PDO, передав параметры соединения
        // при помощи этого объекта мы будем общаться с БД
     //   $dsn = "mysql:host=$host;dbname=$dbname";
     //   $db = new PDO($dsn, $user, $password);
        $db=Db::getConnection(); 
        $newsList = array(); // создадим пустой массив для результатов
        
        //опишем нужный запрос к базе данных
        $result = $db->query('SELECT id, title, date, short_content FROM test_news ORDER BY date DESC LIMIT 10');
        
        
        // в цикле будем получать доступ к переменной $row, которая строка из базы данных
        // мы записываем полученные данные в массив результата $newsList и далее возвращаем этот 
        // 
       
        $i=0;
        
        while ($row = $result -> fetch()) {
            $newsList[$i]['id'] = $row ['id'];
            $newsList[$i]['title'] = $row ['title'];
            $newsList[$i]['date'] = $row ['date'];
            $newsList[$i]['short_content'] = $row ['short_content'];
               $i++;
        }
        return $newsList;
    }
    
}
