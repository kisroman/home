<?php
namespace LovelySpace\Model\Order;

use ClassCreator;
use Framework\Db\Connection;

class OrderItemRepository
{
    public function get($orderId)
    {
        /** @var \LovelySpace\Model\Resource\Order\Order $orderResource */
        $orderResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\Order::class);

        $orderArray = $orderResource->getOrder($orderId);
        $order = ClassCreator::get(Order::class, $orderArray);

        return $order;
    }

    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\Order\OrderItem $orderItemResource */
        $orderItemResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\OrderItem::class);
        $orders = [];
        $ordersItemsArray = $orderItemResource->getModelsArray();

        foreach ($ordersItemsArray as $orderItemArray) {
            $orders[] = ClassCreator::get(\LovelySpace\Model\Order\OrderItem::class, $orderItemArray);
        }

        return $orders;
    }

    public function getListByOrderId($orderId)
    {
        /** @var \LovelySpace\Model\Resource\Order\OrderItem $orderItemResource */
        $orderItemResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\OrderItem::class);
        $ordersItems = [];
        $ordersItemsArray = $orderItemResource->getModelsArray($orderId);

        foreach ($ordersItemsArray as $orderItemArray) {
            $ordersItems[] = ClassCreator::get(\LovelySpace\Model\Order\OrderItem::class, $orderItemArray);
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
            if (isset($reportOrderItems[$orderItem->getId()])) {
                $earn = $reportOrderItems[$orderItem->getId()]->getPrice()
                - $reportOrderItems[$orderItem->getId()]->getCost();
            } else {
                $earn = 'Проблема';
            }
            $productNames .= $orderItem->getProductName() . '(' . $earn . 'грн)</br>';
            $earns += (int)$earn;
        }
        $productNames = substr($productNames, 0, -5);

        return [$productNames, $earns];
    }

    public function getProductNamesWithDiffByOrderId($orderId, $reportOrderItems)
    {
        $ordersItems = $this->getListByOrderId($orderId);
        $productNames = '';
        $earns = 0;

        /** @var OrderItem $orderItem */
        foreach ($ordersItems as $orderItem) {
            if (isset($reportOrderItems[$orderItem->getId()])) {
                $diff = $reportOrderItems[$orderItem->getId()]->getPrice()
                    - $reportOrderItems[$orderItem->getId()]->getCost();
                $earn = $reportOrderItems[$orderItem->getId()]->getPrice() . ' - '
                    . $reportOrderItems[$orderItem->getId()]->getCost() . ' = ' . $diff;
            } else {
                $earn = 'Проблема';
                $diff = 'Проблема';
            }
            $productNames .= $orderItem->getProductName() . '(' . $earn . 'грн)</br>';
            $earns += (int)$diff;
        }
        $productNames = substr($productNames, 0, -5);

        return [$productNames, $earns];
    }
}
