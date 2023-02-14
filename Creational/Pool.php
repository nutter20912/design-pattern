<?php

class Worker
{
}

class WorkPool
{
    public $pendingWorkers = [];
    public $freeWorkers = [];

    public function get(): Worker
    {
        $worker = (count($this->freeWorkers) === 0)
            ? new Worker()
            : $worker = array_pop($this->freeWorkers);

        $this->pendingWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose($worker): void
    {
        $key = spl_object_hash($worker);
        if (isset($this->pendingWorkers[$key])) {
            unset($this->pendingWorkers[$key]);
            $this->freeWorkers[] = $worker;
        }
    }
}

$pool = new WorkPool();

$worker1 = $pool->get();
$worker2 = $pool->get();

$pool->dispose($worker2);

print("pendding: " . count($pool->pendingWorkers) . PHP_EOL);
print("free: " . count($pool->freeWorkers) . PHP_EOL);