<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

abstract class AbstractModel
{
    const TABLE_NAME = '';

    protected $idField = 'id';
    
    public function getModelsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $modelSql = $connection->select(self::TABLE_NAME);
        $modelsArray = $modelSql ? $modelSql->fetch_all(MYSQLI_ASSOC) : [];

        return $modelsArray;
    }

    public function getModel($modelId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $modelSql = $connection->select(self::TABLE_NAME, '*', $this->idField . '=' . $modelId);

        return $modelSql ? $modelSql->fetch_assoc() : [];
    }

    public function save($object)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $vars = get_object_vars($object);
        $reflection = new \ReflectionClass(get_class($object));
        $class = $reflection->getDefaultProperties();
//        if ($orderItem->getId()) {
//            $connection->update(
//                self::TABLE_NAME,
//                'product_id = "' . $orderItem->getProductId() . '"'
//                . ', order_id = "' . $orderItem->getOrderId() . '"'
//                . ', product_name = "' . $orderItem->getProductName() . '"'
//                . ', price = ' . $orderItem->getPrice()
//                . ', qty = "' . $orderItem->getQty() . '"',
//                'id = "' . $orderItem->getId() . '"'
//            );
//        } else {
//            $connection->insert(
//                self::TABLE_NAME,
//                'null, "' . $orderItem->getProductId() . '", "' . $orderItem->getOrderId() . '"
//                , "' . $orderItem->getProductName() . '", "'
//                . $orderItem->getPrice() . '", "' . $orderItem->getQty() . '"',
//                'id, product_id, order_id, product_name, price, qty'
//            );
//        }
    }
}
