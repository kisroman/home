<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

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

        $this->initResource(\LovelySpace\Model\Resource\OrderItem::class);
    }

    /**
     * @return \LovelySpace\Model\Order|null
     */
    public function getOrder()
    {
        /** @var \LovelySpace\Model\OrderRepository $orderRepository */
        $orderRepository = \ClassCreator::get(\LovelySpace\Model\OrderRepository::class);
        $order = $orderRepository->get($this->getOrderId());

        return $order->getId() ? $order : null;
    }
}
