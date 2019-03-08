<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

/**
 * @method int getId()
 * @method string getProductName()
 * @method int getProductId()
 * @method int getPrice()
 * @method int getQty()
 * @method int getOrderId()
 */
class OrderItem extends AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\OrderItem::class);
    }
}
