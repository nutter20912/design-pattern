<?php
/**
 * Factory Pattern 工廠模式
 */
interface Shape
{
    public function draw();
}

class Circle implements Shape
{
    public function draw()
    {
        echo 'Circle';
    }
}

class Square implements Shape
{
    public function draw()
    {
        echo 'Square';
    }
}

enum ShapeType: string
{
    case Circle = 'Circle';
    case Square = 'Square';
}

class ShapeFactory
{
    public static function create(ShapeType $shapeType)
    {
        return match ($shapeType) {
            ShapeType::Circle => new Circle(),
            ShapeType::Square => new Square(),
        };
    }
}

$circle = ShapeFactory::create(ShapeType::Circle);
$circle->draw();
