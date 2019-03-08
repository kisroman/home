<?php

namespace LovelySpace\Model;


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

        $this->initResource(\LovelySpace\Model\Resource\Order::class);
    }
}
