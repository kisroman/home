<?php

namespace LovelySpace\Model;

/**
 * @method int getId()
 * @method int getTotal()
 * @method int getGrandTotal()
 * @method string getDate()
 * @method int getShipment()
 * @method int getShopId()
 */
class Arrival extends AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Arrival::class);
    }
}
