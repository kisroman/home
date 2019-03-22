<?php

namespace LovelySpace\Model\Spending;

use LovelySpace\Model\AbstractModel;

/**
 * @method int getId()
 * @method int getSum()
 * @method string getDate()
 * @method string getComment()
 */
class Spending extends AbstractModel
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Spending\Spending::class);
    }
}
