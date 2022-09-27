<?php

class Router {
   
    private $routes; // массив в котором будут хранится маршруты
    
    public function __construct() { // в нем прочитаем и запомнит маршруты(роуты) из файла с роутами
        $routerPath=ROOT.'/config/routes.php'; // в переменную записываем адрес файла с роутами
        $this->routes = include ($routerPath); // здесь мы через псевдопеременную, при помощи inlude
                                               // записывам в routes массив который хранится в файле routes 
                                               // Теперь в нашем routes хранится массив с роутами
    }
    
    private function getURI() {// метод получает строку запроса, возвращает строку
           if(!empty($_SERVER['REQUEST_URI'])) { // по ключу REQUEST_URI через суперглобальнный массив $_SERVER получаем строку запроса если не пуста
           //return trim($_SERVER['REQUEST_URI'],); // записали строку запроса в $uri, задаем /test1/ для удаления
          
            return substr($_SERVER['REQUEST_URI'], strlen('/test1/')); // так будет удалять /test1/
        }
       
    }
    
    
    public function run() { // принимать управление от FRONTCONTROLLERA(INDEX.PHP)
                            //метод будет анализировать запрос и передавать управление нужному контроллеру
                //echo 'Проверка работы, управление передано методу run';
                 //print_r($this->routes);
        
        //Получим строку запроса
        $uri = $this -> getURI();  //выозвем метод который получает строку запроса
        //echo $uri;
        
        // Проверим наличие такого запроса в routes.php
        // 
        // Для каждого маршрута в нашем массиве $this->routes, мы помещаем в переменную $uriPattern 
        // строку запроса из роутов('news'). А в переменную path мы помещаем путь обработчика 
        foreach ($this->routes as $uriPattern => $path){
            //echo "<br> $uriPattern -> $path";
            
        // Сравним полученную строку запроса и данные в роутах
            // с помощью ф-ии
            
            if(preg_match("~$uriPattern~", $uri)) { 
                        
            // если условие соблюдается, то в переменной $path 
            //будет находится имя (контроллера) и (action)метод
               // echo $path;
                
             //Получим внутренний путь согласно правилу
                // В нашей строке запроса $uri мы ищем параметры $path по шаблону "~$uriPattern~"
                //Если мы находим эти параметры, то в строку $path мы их подставляем
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //echo '<br> Нужно сформировать: '.  $internalRoute;
                
                
                
        //определим какой контроллер обрабатывает запрос
                
            $segments = explode('/', $internalRoute); //разделим строку на две часть делителем '/' с помощью explode
            // получим массив , где две части выражения, первая часть относится к нужному контроллеру
            // вторая к методу action
           // print_r($segments);
            
        // Получим имя контроллера
            
            $controllerName = array_shift($segments). 'Controller'; // array_shift получает значение первого элемента массива
            // и удаляет его из массива в строку  $controllerName. К этому значению мы добавляем слово 'Controller', чтобы получилось нужное название контроллера
            $controllerName = ucfirst($controllerName); // делаем первую букву строки заглавнной
            //$controllerName;
            
        // Получим имя метода action
            $actionName = 'action'.ucfirst(array_shift($segments));  // array_shift получает значение оставшегося элемента массива
            //и удаляет его из массива в строку $actionName.К этому значению мы добавляем слово'action'чтобы получилось нужное название метода
            
        // Получим параметры 
            //после действий выше остануться только параметры
            
            $parameters = $segments;
          //  print_r($parameters);
            
            
        //Подключим файл класса контролера,
        // в зависимости от запроса в адресной строки
            $controllerFILE = ROOT . '/controllers/'.$controllerName.'.php';
            
            if(file_exists($controllerFILE)) { //заранее провряем существует ли такой файл на диске
                require_once ($controllerFILE);   
            }
            
        //Вызвать метод action, создвав объект нужного нам класса Контроллера
            $controllerObject = new $controllerName;
            
            
            //$result = $controllerObject -> $actionName($parameters); // вызываем метод, передаем ему параметры
            
            $result= call_user_func_array(array($controllerObject, $actionName), $parameters); //ф-я call_user_func_array
            // вызываем метод $actionName у объекта $controllerObject, при этом передает ему массив с параметрами
            
            if ($result != null) {
                break;
            }
            
            }
        }
    }
}
