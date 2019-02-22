<?php

namespace LovelySpace\Model;

class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $id;

    public function __construct($productData)
    {
        $this->id = isset($productData['id']) ? $productData['id'] : null;
        $this->name = isset($productData['name']) ? $productData['name'] : null;
        $this->price = isset($productData['price']) ? $productData['price'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
