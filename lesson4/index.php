<?php
// setcookie($currentID, 0);


// Подключаем класс коннекта к базе данных
require_once ('Classes/DB.php');

// Подгружаем и активируем автозагрузчик Twig-а
require_once '../vendor/twig/twig/lib/twig/Autoloader.php';
Twig_Autoloader::register();

$lastID = $_GET['id'];

if (!$lastID) {
    $lastID = 0;
}

$limit = $lastID + 3;

try {
    // Указываем где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // Инициализируем Twig
    $twig = new Twig_Environment($loader);

    // Подгружаем шаблон
    $template = $twig->loadTemplate('gallery.php');

    // Делаем запрос в БД
    $dataForRender = DB::getAll("SELECT * FROM `gallery` limit $limit");

    // $dataForRender = DB::getAll("SELECT * FROM `gallery` WHERE `id` > :id limit 3", ['id' => $currentID]);

    // Передаем в шаблон переменные и значения, полученные из БД
    // Выводим сформированное содержание
    $content = $template->render(
        [
            'data' => $dataForRender,
            'lastID' => array_key_last($dataForRender)
        ]
    );

    // print_r($dataForRender);

    // echo array_key_last($dataForRender);

    echo $content;
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}

// try {
//     // Указываем где хранятся шаблоны
//     $loader = new Twig_Loader_Filesystem('templates');

//     // Инициализируем Twig
//     $twig = new Twig_Environment($loader);

//     // Подгружаем шаблон
//     $template = $twig->loadTemplate('gallery.php');

//     // Делаем запрос в БД
//     $dataForRender = DB::getAll("SELECT * FROM `gallery` limit 3");
    
//     // $dataForRender = DB::getAll("SELECT * FROM `gallery` WHERE `id` > :id limit 3", ['id' => $currentID]);

//     // Передаем в шаблон переменные и значения, полученные из БД
//     // Выводим сформированное содержание
//     $content = $template->render(
//         [
//             'data' => $dataForRender,
//             'lastID' => array_key_last($dataForRender)
//         ]
//     );

//     // print_r($dataForRender);
    
//     // echo array_key_last($dataForRender);

//     echo $content;
// } catch (Exception $e) {
//     die('ERROR: ' . $e->getMessage());
// }
