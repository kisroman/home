<?php

namespace LovelySpace\Model;

use ClassCreator;

class Arrival
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
     * @var int
     */
    private $grandTotal;
    
    /**
     * @var string
     */
    private $date;

    /**
     * @var int
     */
    private $shipment;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->total = isset($data['total']) ? $data['total'] : null;
        $this->grandTotal = isset($data['grand_total']) ? $data['grand_total'] : null;
        $this->date = isset($data['date']) ? $data['date'] : null;
        $this->shipment = isset($data['shipment']) ? $data['shipment'] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getShipment()
    {
        return $this->shipment;
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\Arrival $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival::class);
        $id = $resource->save($this);

        return $id;
    }
}
