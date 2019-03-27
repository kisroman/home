<?php
namespace LovelySpace\Model\Order;

use ClassCreator;
use Framework\Db\Connection;
use Framework\MessageManager;

class OrderRepository
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
        /** @var \LovelySpace\Model\Resource\Order\Order $orderResource */
        $orderResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\Order::class);
        $ordersArray = $orderResource->getModelsArray();

        $orders = [];
        foreach ($ordersArray as $orderArray) {
            $orders[] = ClassCreator::get(Order::class, $orderArray);
        }

        return $orders;
    }

    public function getListWithinDate($dateFrom = null, $dateTo = null)
    {
        /** @var \LovelySpace\Model\Resource\Order\Order $orderResource */
        $orderResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\Order::class);
        $ordersArray = $orderResource->getModelsArrayWithInDate($dateFrom, $dateTo);

        $orders = [];
        foreach ($ordersArray as $orderArray) {
            $orders[] = ClassCreator::get(Order::class, $orderArray);
        }

        return $orders;
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
        foreach ($data['price'] as $productId => $cost) {
            $itemsArray[$productId]['price'] = $cost;
        }
        foreach ($data['qty'] as $productId => $qty) {
            $itemsArray[$productId]['qty'] = $qty;
            $total += $qty * $data['price'][$productId];
        }

        $orderArray['id'] = isset($data['id']) ? $data['id'] : null;
        $orderArray['date'] = date('Y-m-d');
        $orderArray['total'] = $total;
        $orderArray['client_id'] = isset($data['client_id']) ? $data['client_id'] : null;;

        if (!$orderArray['id']) {
            $orderArray['date'] = date('Y-m-d');
        }

        /** @var Order $order */
        $order = ClassCreator::get(Order::class, $orderArray);
        $id = $order->save();

        if ($order->getId()) {
            $id = $order->getId();
        }

        /** @var \LovelySpace\Model\Resource\Order\OrderItem $orderItemResource */
        $orderItemResource = ClassCreator::get(\LovelySpace\Model\Resource\Order\OrderItem::class, $orderArray);
        // delete all items for order to create news
        $orderItemResource->deleteByOrderId($id);

        foreach ($itemsArray as $itemArray) {
            $itemArray['order_id'] = $id;
            /** @var OrderItem $ordersItem */
            $ordersItem = ClassCreator::get(OrderItem::class, $itemArray);
            $ordersItem->save();
        }
    }
}
