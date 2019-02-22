<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $arrivalId;

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
    private $cost;

    /**
     * @var int
     */
    private $qty;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->arrivalId = isset($data['arrival_id']) ? $data['arrival_id'] : null;
        $this->productId = isset($data['product_id']) ? $data['product_id'] : null;
        $this->productName = isset($data['product_name']) ? $data['product_name'] : null;
        $this->cost = isset($data['cost']) ? $data['cost'] : null;
        $this->qty = isset($data['qty']) ? $data['qty'] : null;
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\ArrivalItem $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class);
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
    public function getCost()
    {
        return $this->cost;
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
    public function getArrivalId()
    {
        return $this->arrivalId;
    }
}
