<?php
// 1. Создать структуру классов ведения товарной номенклатуры.
// а) Есть абстрактный товар.
// б) Есть цифровой товар, штучный физический товар и товар на вес.
// в) У каждого есть метод подсчета финальной стоимости.
// г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
// д) Что можно вынести в абстрактный класс, наследование?

abstract class Goods
{
    private $name;
    private $price;
    private $count;
    private $result;
    private $type;

    abstract protected function getCost();
}

class DigitalGoods extends Goods
{
    public function __construct($name, $price, $count, $type)
    {
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
        $this->type = $type;
    }

    public function getCost()
    {
        $this->result = $this->price * $this->count;
        return "{$this->type} товар '{$this->name}' продан на сумму {$this->result} рублей.";
    }
}

class PieceGoods
{
    private $count;
    private $type;

    public function __construct($count, $type)
    {
        $this->count = $count;
        $this->type = $type;
    }

    public function getCostPiece(DigitalGoods $good)
    {
        $good->price = $good->price * 2;
        $good->count = $this->count;
        $good->type = $this->type;
        return $good->getCost();
    }
}

class WeightGoods extends DigitalGoods
{
    public function getCost()
    {
        $this->result = $this->price * $this->count;
        return "{$this->type} товар '{$this->name}' весом {$this->count} кг продан на сумму {$this->result} рублей.";
    }
}

$digitalGood = new DigitalGoods('Фотография', 100, 15, 'Цифровой');
echo $digitalGood->getCost() . PHP_EOL;

$pieceGood = new PieceGoods(100, 'Штучный');
echo $pieceGood->getCostPiece($digitalGood) . PHP_EOL;

$digitalGood = new WeightGoods('Фотография', 3, 15, 'Весовой');
echo $digitalGood->getCost() . PHP_EOL;


// 2. *Реализовать паттерн Singleton при помощи traits.

trait CRUD {
    public function select() {return 'select';}
    public function insert() {return 'insert';}
    public function delete() {return 'delete';}
}

class DB {
    static $object;
    static $connect;
    const host = '127.0.0.1';
    const db_name = 'table';
    const user = 'root';
    const password = '';

    private function __construct() {
        DB::$connect = mysqli_connect(self::host, DB::user, DB::password, self::db_name);
    }

    private static function getObject() {
        if (self::$object == null) {
            DB::$object = new DB;
        }
        return self::$object;
    }

    use CRUD;
}