<?php
/**
 * Prototype Pattern 原型模式
 *
 * 創建一個原型類，使用此原型clone，快速創建實例節省開銷
 */
abstract class Book
{
    protected $title;
    abstract public function __clone();

    public function getTitle()
    {
        echo $this->title;
    }
}

class FoodBook extends Book
{
    protected $title = 'seaFood';
    public function __clone()
    {

    }
}

$foodBook = new FoodBook();
$book1 = clone $foodBook;
$book2 = clone $foodBook;

var_dump($book1 instanceof FoodBook);
var_dump($book2 instanceof FoodBook);