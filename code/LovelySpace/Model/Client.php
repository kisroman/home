<?php

namespace LovelySpace\Model;

/**
 * @method int getId()
 * @method string getName()
 * @method int getPhone()
 */
class Client extends AbstractModel
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Client::class);
    }
}
