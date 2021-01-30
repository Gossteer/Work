<?php

class InvoiceComposition
{
    /**
     * @var id $id
     */
    private int $id;
    /**
     * @var float $sum
     */
    private float $sum;
    /**
     * @var float $count
     */
    public float $count;
    /**
     * @var float $name
     */
    public string $name;

    public function __construct(int $id, string $name , float $sum = 0, float $count = 0)
    {
        $this->id = $id;
        $this->sum = $sum;
        $this->count = $count;
        $this->name = $name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

}