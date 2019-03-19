<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class OrderItemRepository
{
    public function get($orderId)
    {
        /** @var \LovelySpace\Model\Resource\Order $orderResource */
        $orderResource = ClassCreator::get(\LovelySpace\Model\Resource\Order::class);

        $orderArray = $orderResource->getOrder($orderId);
        $order = ClassCreator::get(Order::class, $orderArray);

        return $order;
    }

    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\OrderItem $orderItemResource */
        $orderItemResource = ClassCreator::get(\LovelySpace\Model\Resource\OrderItem::class);
        $orders = [];
        $ordersItemsArray = $orderItemResource->getModelsArray();

        foreach ($ordersItemsArray as $orderItemArray) {
            $orders[] = ClassCreator::get(\LovelySpace\Model\OrderItem::class, $orderItemArray);
        }

        return $orders;
    }

    public function getListByOrderId($orderId)
    {
        /** @var \LovelySpace\Model\Resource\OrderItem $orderItemResource */
        $orderItemResource = ClassCreator::get(\LovelySpace\Model\Resource\OrderItem::class);
        $ordersItems = [];
        $ordersItemsArray = $orderItemResource->getModelsArray($orderId);

        foreach ($ordersItemsArray as $orderItemArray) {
            $ordersItems[] = ClassCreator::get(\LovelySpace\Model\OrderItem::class, $orderItemArray);
        }

        return $ordersItems;
    }

    public function getProductNamesByOrderId($orderId, $reportOrderItems)
    {
        $ordersItems = $this->getListByOrderId($orderId);
        $productNames = '';
        $earns = 0;

        /** @var OrderItem $orderItem */
        foreach ($ordersItems as $orderItem) {
            $earn = isset($reportOrderItems[$orderItem->getId()]) ? $reportOrderItems[$orderItem->getId()] : 0 ;
            $productNames .= $orderItem->getProductName() . '(' . $earn . 'грн)</br>';
            $earns += $earn;
        }
        $productNames = substr($productNames, 0, -5);

        return [$productNames, $earns];
    }
}
