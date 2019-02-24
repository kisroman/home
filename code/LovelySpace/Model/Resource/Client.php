<?php

namespace LovelySpace\Model\Resource;

use ClassCreator;
use Framework\Db\Connection;

class Client
{
    const TABLE_NAME = 'client';

    public function save(\LovelySpace\Model\Client $client)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if ($client->getId()) {
            $result = $connection->update(
                self::TABLE_NAME,
                'name = "' . $client->getName() . '"'
                . ', instagram_name = "' . $client->getInstagramName() . '"'
                . ', phone = "' . $client->getPhone() . '"',
                'id = "' . $client->getId() . '"'
            );
        } else {
            $result = $connection->insert(
                self::TABLE_NAME,
                'null, "' . $client->getName() . '", "' . $client->getInstagramName() . '"'
                . ', "' . $client->getPhone() . '"',
                'id, name, instagram_name, phone'
            );
        }

        return $result;
    }

    public function getClientsArray()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $clientSql = $connection->select(self::TABLE_NAME);
        $clientsArray = $clientSql->fetch_all(MYSQLI_ASSOC);

        return $clientsArray;
    }

    public function getClient($clientId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $clientSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $clientId);

        return $clientSql ? $clientSql->fetch_assoc() : [];
    }
}
