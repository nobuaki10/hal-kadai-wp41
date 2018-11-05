<?php
require_once("Animal.class.php");

$a = new Animal();
$a->sleep();

require_once("Dog.class.php");

$b = new Dog();
$b->sleep();
$b->bite();
