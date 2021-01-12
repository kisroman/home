<?php

namespace LovelySpace\Model\Order;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\AbstractModel;

/**
 * @method int getId()
 * @method string getProductName()
 * @method int getProductId()
 * @method int getPrice()
 * @method int getQty()
 * @method int getOrderId()
 */
class OrderItem extends AbstractModel
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->initResource(\LovelySpace\Model\Resource\Order\OrderItem::class);
    }

    /**
     * @return \LovelySpace\Model\Order\Order|null
     */
    public function getOrder()
    {
        /** @var \LovelySpace\Model\Order\OrderRepository $orderRepository */
        $orderRepository = \ClassCreator::get(\LovelySpace\Model\Order\OrderRepository::class);
        $order = $orderRepository->get($this->getOrderId());

        return $order->getId() ? $order : null;
    }
}
