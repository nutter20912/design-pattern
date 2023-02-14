<?php

/**
 * Builder Pattern 建造者模式
 *
 * 將複雜的建構與其表示相分離，使同樣建構過程可創建不同結果
 *
 * 與工廠模式區別，建造者模式更加關注與零件的裝配順序
 */
// interface
interface Packing
{
    public function pack();
}
interface Item
{
    public function name(): string;
    public function packing(): Packing;
    public function price(): float;
}

//class
class Wrapper implements Packing
{
    public function pack()
    {
        echo 'wapper';
    }
}
class Bottle implements Packing
{
    public function pack()
    {
        echo 'bottle';
    }
}
//抽象類
abstract class Burger implements Item
{
    public function packing(): Packing
    {
        return new Wrapper();
    }
}
abstract class Drink implements Item
{
    public function packing(): Packing
    {
        return new Bottle();
    }
}
//子類
class BeefBurger extends Burger
{
    public function name(): string
    {
        return 'Beef';
    }

    public function price(): float
    {
        return 10;
    }
}
class Coke extends Drink
{
    public function name(): string
    {
        return 'coke';
    }
    public function price(): float
    {
        return 20;
    }
}

class Meal
{
    /**
     * @var Item[]
     */
    public $items = [];
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }
    public function showCost()
    {
        $cost = array_reduce(
            $this->items,
            fn ($pre, Item $item) => $pre + $item->price(),
            0
        );

        print("cost: {$cost}");
    }
    public function showItems(): void
    {
        foreach ($this->items as $item) {
            print("item: {$item->name()}\n");
        }
    }
}
//建造類關注零件組合
class MealBuilder
{
    public function prepareMeatMeal(): Meal
    {
        return (new Meal())
            ->addItem(new BeefBurger())
            ->addItem(new Coke());
    }
    public function prepareVegMeal()
    {
        //組合素食餐
    }
}

$mealBuilder = new MealBuilder();
$meal = $mealBuilder->prepareMeatMeal();
$meal->showItems();
$meal->showCost();
