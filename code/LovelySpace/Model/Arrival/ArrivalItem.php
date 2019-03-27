<?php

namespace LovelySpace\Model\Arrival;

use ClassCreator;
use Framework\Db\Connection;

/**
 * @method int getId()
 * @method string getProductName()
 * @method int getProductId()
 * @method int getCost()
 * @method int getQty()
 * @method int getArrivalId()
 */
class ArrivalItem extends \LovelySpace\Model\AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Arrival\ArrivalItem::class);
    }

    /**
     * @return \LovelySpace\Model\Arrival\Arrival|null
     * @throws \Exception
     */
    public function getArrival()
    {
        /** @var \LovelySpace\Model\Arrival\ArrivalRepository $arrivalRepository */
        $arrivalRepository = \ClassCreator::get(\LovelySpace\Model\Arrival\ArrivalRepository::class);
        if ($this->getArrivalId()) {
            $arrival = $arrivalRepository->get($this->getArrivalId());
        } else {
            throw new \Exception('Arrival id is' . $this->getArrivalId() . '. Треба перевірити код');
        }

        return $arrival->getId() ? $arrival : null;
    }
}
