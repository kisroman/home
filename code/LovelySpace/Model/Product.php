<?php

namespace LovelySpace\Model;

/**
 * @method int getId()
 * @method string getName()
 * @method int getPrice()
 */
class Product extends AbstractModel
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Product::class);
    }
}
