<?php
/**
 * Abstract Pattern 抽象工廠模式
 *
 * 超級工廠創建其他工廠, 由其他工廠決定一系列具體 class
 */

// interface
interface Engine
{
    public function launch();
}
interface CarFactory
{
    public function createEngine(): Engine;
}

// class
class BMWEngine implements Engine
{
    public function launch()
    {
        return 'launch';
    }
}

class TeslaEngine implements Engine
{
    public function launch()
    {
        return 'launch';
    }
}

// 其他工廠
class BMWFactory implements CarFactory
{
    public function createEngine(): Engine
    {
        return new BMWEngine();
    }
}
class TeslaFactory implements CarFactory
{
    public function createEngine(): Engine
    {
        return new TeslaEngine('Battery');
    }
}

enum CarType: string
{
    case BMW = 'BMW';
    case Tesla = 'Tesla';
}

// 超級工廠
class FactoryProducer
{
    public static function createFactory(CarType $carType): CarFactory
    {
        return match($carType) {
            CarType::BMW => new BMWFactory(),
            CarType::Tesla => new TeslaFactory(),
        };
    }
}

$bmwFactory = FactoryProducer::createFactory(CarType::BMW);
$bmwFactory->createEngine()->launch();