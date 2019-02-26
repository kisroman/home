<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ArrivalRepository
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
        /** @var \LovelySpace\Model\Resource\Arrival $arrivalResource */
        $arrivalResource = ClassCreator::get(\LovelySpace\Model\Resource\Arrival::class);
        $arrivals = [];
        $arrivalsArray = $arrivalResource->getArrivalsArray();

        foreach ($arrivalsArray as $arrivalArray) {
            $arrivals[] = ClassCreator::get(Arrival::class, $arrivalArray);
        }

        /** @var Arrival $arrival */
//        foreach ($arrivals as $arrival) {
//            /** @var \LovelySpace\Model\ArrivalItemRepository $arrivalItemRepository */
//            $arrivalItemRepository = \ClassCreator::get(\LovelySpace\Model\ArrivalItemRepository::class);
//            $items = $arrivalItemRepository->getListByArrivalId($arrival->getId());
//            /** @var ArrivalItem $item */
//            foreach ($items as $item) {
//                $productId = $item->getProductId();
//                $qty = $item->getQty();
//                /** @var \LovelySpace\Model\ProductStock $productStock */
//                $productStock = \ClassCreator::get(\LovelySpace\Model\ProductStock::class,
//                    [
//                        'product_id' => $productId,
//                        'qty' => $qty,
//                        'total' => '-' . $item->getCost() * $qty,
//                    ]);
//                $productStock->save();
//            }
//        }
        return $arrivals;
    }

    public function save($data)
    {
        $itemsArray = [];
        $total = 0;
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
        $arrivalArray['shipment'] = $data['shipment_cost'];
        $arrivalArray['date'] = date('Y-m-d');
        $arrivalArray['total'] = $total;
        $arrivalArray['grand_total'] = $total + $data['shipment_cost'];

        /** @var Arrival $arrival */
        $arrival = ClassCreator::get(Arrival::class, $arrivalArray);
        $id = $arrival->save();

        if ($arrival->getId()) {
            $id = $arrival->getId();
        }

        /** @var \LovelySpace\Model\Resource\ArrivalItem $arrivalItemResource */
        $arrivalItemResource = ClassCreator::get(\LovelySpace\Model\Resource\ArrivalItem::class, $arrivalArray);
        // delete all items for arrival to create news
        $arrivalItemResource->deleteByArrivalId($id);

        foreach ($itemsArray as $itemArray) {
            $itemArray['arrival_id'] = $id;
            /** @var ArrivalItem $arrivalsItem */
            $arrivalsItem = ClassCreator::get(ArrivalItem::class, $itemArray);
            $arrivalsItem->save();

            /** @var ProductStockRepository $productStockRepository */
            $productStockRepository = ClassCreator::get(ProductStockRepository::class);
            $productStockRepository->save([
                'product_id' => $arrivalsItem->getProductId(),
                'qty' =>  $arrivalsItem->getQty(),
                'total' => '-' . ($arrivalsItem->getCost() * $arrivalsItem->getQty()),
            ]);
        }
    }
}
