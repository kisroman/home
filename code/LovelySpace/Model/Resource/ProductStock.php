<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class ProductStock
{
    const TABLE_NAME = 'product_stock';
    
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

    public function save($model)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($model->getId()) {
            $result= $connection->update(
                self::TABLE_NAME,
                'product_id = "' . $model->getProductId()
                . '", qty = "' . $model->getQty()
                . '", total = "' . $model->getTotal() . '"',
                'id = "' . $model->getId() . '"'
            );
        } else {
            $result = $connection->insert(
                self::TABLE_NAME,
                'null, "' . $model->getProductId() . '", "' . $model->getQty() . '", "' . $model->getTotal() . '"',
                'id, product_id, qty, total'
            );
        }
        return $result;
    }
}
