<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\DataObject;
use Framework\Db\Connection;

abstract class AbstractModel
{
    const TABLE_NAME = '';

    protected $idField = 'id';

    public function getModelsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $modelSql = $connection->select(static::TABLE_NAME);
        $modelsArray = $modelSql ? $modelSql->fetch_all(MYSQLI_ASSOC) : [];

        return $modelsArray;
    }

    public function getModel($modelId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $modelSql = $connection->select(static::TABLE_NAME, '*', $this->idField . '=' . $modelId);

        return $modelSql ? $modelSql->fetch_assoc() : [];
    }

    public function save(DataObject $model)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($model->getId()) {
            $updateString = '';
            foreach ($model->getData() as $key => $value) {
                if ($key !== $this->idField) {
                    $updateString .= '`' . $key . '` = "' . $value . '", ';
                }
            }
            $updateString = substr($updateString, 0, -2);

            $result = $connection->update(static::TABLE_NAME, $updateString, '`id` = "' . $model->getId() . '"');
        } else {
            $updateString = 'null, ';
            $keys = '`' . $this->idField . '`, ';
            foreach ($model->getData() as $key => $value) {
                if ($key !== $this->idField) {
                    $updateString .= '"' . $value . '", ';
                    $keys .= '`' . $key . '`, ';
                }
            }
            $updateString = substr($updateString, 0, -2);
            $keys = substr($keys, 0, -2);

            $result = $connection->insert(static::TABLE_NAME, $updateString, $keys);
        }

        return $result;
    }
}
