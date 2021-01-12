<?php

namespace LovelySpace\Model\Shop;

use LovelySpace\Model\AbstractModel;

/**
 * @method int getId()
 * @method string getName()
 */
class Shop extends AbstractModel
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Shop\Shop::class);
    }
}
