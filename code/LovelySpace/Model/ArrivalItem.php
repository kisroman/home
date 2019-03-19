<?php

namespace LovelySpace\Model;

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
class ArrivalItem extends AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\ArrivalItem::class);
    }

    /**
     * @return \LovelySpace\Model\Arrival|null
     */
    public function getArrival()
    {
        /** @var \LovelySpace\Model\ArrivalRepository $arrivalRepository */
        $arrivalRepository = \ClassCreator::get(\LovelySpace\Model\ArrivalRepository::class);
        $arrival = $arrivalRepository->get($this->getArrivalId());

        return $arrival->getId() ? $arrival : null;
    }
}
