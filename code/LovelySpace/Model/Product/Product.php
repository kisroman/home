<?php

namespace LovelySpace\Model\Product;

/**
 * @method int getId()
 * @method string getName()
 * @method int getPrice()
 */
class Product extends \LovelySpace\Model\AbstractModel
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Product\Product::class);
    }
}
