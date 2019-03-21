<?php

namespace LovelySpace\Model\Order;

use LovelySpace\Model\AbstractModel;


/**
 * @method int getId()
 * @method int getTotal()
 * @method string getDate()
 * @method int getClientId()
 */
class Order extends AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Order\Order::class);
    }
}
