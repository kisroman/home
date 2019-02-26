<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\DataObject;

class ProductStock extends DataObject
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $qty;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var string
     */
    private $total;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->qty = isset($data['qty']) ? $data['qty'] : null;
        $this->productId = isset($data['product_id']) ? $data['product_id'] : null;
        $this->total = isset($data['total']) ? $data['total'] : null;

        parent::__construct($data);
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\ProductStock $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\ProductStock::class);
        $id = $resource->save($this);

        return $id;
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
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }
}
