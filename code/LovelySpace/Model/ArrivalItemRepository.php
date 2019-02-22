<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalItemRepository
{
    public function get($arrivalId)
    {
        /** @var \LovelySpace\Model\Resource\Arrival $arrivalResource */
        $arrivalResource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival::class);

        $arrivalArray = $arrivalResource->getArrival($arrivalId);
        $arrival = ClassCreator::get(Arrival::class, $arrivalArray);

        return $arrival;
    }

    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\ArrivalItem $arrivalItemResource */
        $arrivalItemResource = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class);
        $arrivals = [];
        $arrivalsItemsArray = $arrivalItemResource->getArrivalsItemsArray();

        foreach ($arrivalsItemsArray as $arrivalItemArray) {
            $arrivals[] = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class, $arrivalItemArray);
        }

        return $arrivals;
    }

    public function getListByArrivalId($arrivalId)
    {
        /** @var \LovelySpace\Model\Resource\ArrivalItem $arrivalItemResource */
        $arrivalItemResource = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class);
        $arrivalsItems = [];
        $arrivalsItemsArray = $arrivalItemResource->getArrivalsItemsArray($arrivalId);

        foreach ($arrivalsItemsArray as $arrivalItemArray) {
            $arrivalsItems[] = ClassCreator::get(\LovelySpace\Model\ArrivalItem::class, $arrivalItemArray);
        }

        return $arrivalsItems;
    }

    public function getProductNamesByArrivalId($arrivalId)
    {
        $arrivalsItems = $this->getListByArrivalId($arrivalId);
        $productNames = '';

        /** @var ArrivalItem $arrivalItem */
        foreach ($arrivalsItems as $arrivalItem) {
            $productNames .= $arrivalItem->getProductName() . ', ';
        }
        $productNames = substr($productNames, 0, -2);

        return $productNames;
    }
}
