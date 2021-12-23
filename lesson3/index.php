<?php
// Подключаем класс коннекта к базе данных
require_once ('Classes/DB.php');

// Подгружаем и активируем автозагрузчик Twig-а
require_once '../vendor/twig/twig/lib/twig/Autoloader.php';
Twig_Autoloader::register();

try {
    // Указываем где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // Инициализируем Twig
    $twig = new Twig_Environment($loader);

    // Подгружаем шаблон
    $template = $twig->loadTemplate('gallery.html');

    // Делаем запрос в БД
    $dataForRender = DB::getAll("SELECT * FROM `gallery`");

    // Передаем в шаблон переменные и значения, полученные из БД
    // Выводим сформированное содержание
    $content = $template->render(
        [
            'data' => $dataForRender
        ]
    );

    echo $content;
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
?>