<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalItemRepository
{
    public function getListByArrivalId($arrivalId)
    {
        /** @var \LovelySpace\Model\Resource\ArrivalItem $arrivalItemResource */
        $arrivalItemResource = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class);
        $arrivalsItems = [];
        $arrivalsItemsArray = $arrivalItemResource->getModelsArray($arrivalId);

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
            $productNames .= $arrivalItem->getProductName() . '</br>';
        }
        $productNames = substr($productNames, 0, -2);

        return $productNames;
    }
}
