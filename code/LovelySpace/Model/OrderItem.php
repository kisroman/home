<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class OrderItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $orderId;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var string
     */
    private $productName;
    
    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $qty;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->orderId = isset($data['order_id']) ? $data['order_id'] : null;
        $this->productId = isset($data['product_id']) ? $data['product_id'] : null;
        $this->productName = isset($data['product_name']) ? $data['product_name'] : null;
        $this->price = isset($data['price']) ? $data['price'] : null;
        $this->qty = isset($data['qty']) ? $data['qty'] : null;
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\OrderItem $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\OrderItem::class);
        $resource->save($this);
    }

    /**
     * @return int
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
