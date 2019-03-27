<?php
namespace LovelySpace\Model\Arrival;

use ClassCreator;
use Framework\MessageManager;

class ArrivalRepository
{
    public function get($arrivalId)
    {
        /** @var \LovelySpace\Model\Resource\Arrival\Arrival $arrivalResource */
        $arrivalResource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival\Arrival::class);

        $arrivalArray = $arrivalResource->getModel($arrivalId);
        $arrival = ClassCreator::get(Arrival::class, $arrivalArray);

        return $arrival;
    }

    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\Arrival\Arrival $arrivalResource */
        $arrivalResource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival\Arrival::class);
        $arrivalsArray = $arrivalResource->getModelsArray();

        $arrivals = [];
        foreach ($arrivalsArray as $arrivalArray) {
            $arrivals[$arrivalArray['id']] = ClassCreator::get(Arrival::class, $arrivalArray);
        }

        return $arrivals;
    }

    public function save($data)
    {
        $itemsArray = [];
        $total = 0;
        if (!isset($data['name'])) {
            MessageManager::addMessage(
                'НЕ ЗБЕРЕЖЕНО. Потрібно додати продукт до находження.',
                MessageManager::TYPE_ERROR
            );
            return;
        }
        foreach ($data['name'] as $productId => $name) {
            $itemsArray[$productId]['product_id'] = $productId;
            $itemsArray[$productId]['product_name'] = $name;
        }
        foreach ($data['cost'] as $productId => $cost) {
            $itemsArray[$productId]['cost'] = $cost;
        }
        foreach ($data['qty'] as $productId => $qty) {
            $itemsArray[$productId]['qty'] = $qty;
            $total += $qty * $data['cost'][$productId];
        }
        $arrivalArray['id'] = isset($data['id']) ? $data['id'] : null;
        $arrivalArray['shop_id'] = $data['shop'];
        if (!$arrivalArray['id']) {
            $arrivalArray['date'] = date('Y-m-d');
        }
        $arrivalArray['total'] = $total;

        /** @var Arrival $arrival */
        $arrival = ClassCreator::get(Arrival::class, $arrivalArray);
        $id = $arrival->save();

        if ($arrival->getId()) {
            $id = $arrival->getId();
        }

        /** @var \LovelySpace\Model\Resource\Arrival\ArrivalItem $arrivalItemResource */
        $arrivalItemResource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival\ArrivalItem::class, $arrivalArray);
        // delete all items for arrival to create news
        $arrivalItemResource->deleteByArrivalId($id);

        foreach ($itemsArray as $itemArray) {
            $itemArray['arrival_id'] = $id;
            /** @var ArrivalItem $arrivalsItem */
            $arrivalsItem = ClassCreator::get(ArrivalItem::class, $itemArray);
            $arrivalsItem->save();
        }
    }
}
