<?php 

namespace Core;

class Route
{
    protected $route_config; //переменная для хранения конфиг файла роутеров

    public function __construct()
    {
        $this->route_config                         = require 'Router/web.php'; // подгружаем конфиг роутеров
    }

    public function __autoload($classname){
        include('Controller/' . $classname . '.php'); // загружаем файл контроллера
        if(!class_exists($classname, false)){ // проверяем, если класса не существует тогда показываем ошибку
            echo "Выбранного класса не существует $classname";
        }
    }

    /*
    *   function index
    *
    *   Входные данные
    *   Принимает значени $_SERVER['REQUEST_URI']
    *
    *   Выходные даннын 
    *   Подгружает нужную функцию и нужный контроллер
    */

    public function index($url)
    {
        if(isset($this -> route_config[$url])){ // проверяем  существует ли значение
            $data                                   = explode('@', $this->route_config[$url]); // разбиваем массив 0 - название контроллера, 1 - название метода
            $this -> __autoload($data[0]); //подгружаем файл и проверяем его на существование класса
            if(class_exists($data[0])) // если класс существует
            {
                echo "Controller $data[0] is exists <br />"; //вывод успеха
                if(method_exists($data[0], $data[1]))
                {
                    echo "Method $data[1] is exists <br />"; // здесь подгружаем/создаем объект метода класса и подгружаем его
                }else{
                    echo "Method $data[1] isn`t exists <br />"; //вывод ошибки метода
                }
            }else{
                echo "Controller $data[0] isn`t exists <br />"; //вывод ошибки контроллера
            }
        }else{
            echo 'Route error'; //вывод ошибки роутера 
        }
    }
}