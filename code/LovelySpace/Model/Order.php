<?php

namespace LovelySpace\Model;

use ClassCreator;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $total;
    
    /**
     * @var string
     */
    private $date;

    /**
     * @var int
     */
    private $clientId;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->total = isset($data['total']) ? $data['total'] : null;
        $this->date = isset($data['date']) ? $data['date'] : null;
        $this->clientId = isset($data['client_id']) ? $data['client_id'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\Order $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\Order::class);
        $id = $resource->save($this);

        return $id;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}
