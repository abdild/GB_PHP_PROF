<?php

class DB
{
    // Данные для подключения к БД
    private static $dsn = 'mysql:dbname=shop;host=localhost';
    private static $userName = 'root';
    private static $password = '';

    // Объект PDO (dbc - date base connect)
    private static $dbc = null;

    // Обработчик запроса в БД
    private static $handler = null;

    // Метод для создания соединения
    public static function dbConnect() {
        try {
            self::$dbc = new PDO(self::$dsn, self::$userName, self::$password);
            return self::$dbc;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Метод запроса всех значений по параметрам
    public static function getAll($query, $param = array())
    {
        self::$handler = self::dbConnect()->prepare($query);
        self::$handler->execute((array) $param);
        return self::$handler->fetchAll(PDO::FETCH_ASSOC);
    }
}


//print_r(DB::getAll("SELECT * FROM `gallery` WHERE `id` = :id OR `src` = :src", ['id' => 3, 'src' => '5.jpg']));