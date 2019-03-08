<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class Shop extends AbstractModel
{
    const TABLE_NAME = '`shop`';

    public function getNameById($id)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $modelSql = $connection->select(static::TABLE_NAME, '`name`', $this->idField . '=' . $id);

        return $modelSql ? $modelSql->fetch_assoc()['name'] : [];
    }
}
