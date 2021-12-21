<?php

// 1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
// 2. Описать свойства класса из п.1 (состояние).
// 3. Описать поведение класса из п.1 (методы).

class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

    public function getUser() {}
    public function getID() {}
    public function getName() {}
    public function getEmail() {}
    public function getPassword() {}
    public function getRole() {}
}

class Item {
    private $id;
    private $price;
    private $visible;
    private $promo;

    public function getItem() {}
    public function getID() {}
    public function getPrice() {}
    public function getVisible() {}
    public function getPromo() {}
}

// 4. Придумать наследников класса из п.1. Чем они будут отличаться?
class Admin extends User {
    public function setUser() {}
    public function deleteUser() {}
    public function editUser() {}
}

// Не знаю какие дочерние классы могут быть у класса Item.

// 5. Дан код:
// class A {
//     public function foo() {
//         static $x = 0;
//         echo ++$x;
//     }
// }
// $a1 = new A();
// $a2 = new A();
// $a1->foo();
// $a2->foo();
// $a1->foo();
// $a2->foo();
// Что он выведет на каждом шаге? Почему?
// Ответ: выведет 1234. Потому что $x статическое свойство и оно относится не к объекту, а к классу.

// Немного изменим п.5:
// class A {
//     public function foo() {
//         static $x = 0;
//         echo ++$x;
//     }
// }
// class B extends A {
// }
// $a1 = new A();
// $b1 = new B();
// $a1->foo(); 
// $b1->foo(); 
// $a1->foo(); 
// $b1->foo();
// 6. Объясните результаты в этом случае.
// Ответ: выведет 1122. Потому что $x статическое свойство относится к классу А, а класс В наследует его значение, а не меняет его самостоятельно.
