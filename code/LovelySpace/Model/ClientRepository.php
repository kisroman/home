<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ClientRepository
{
    const TABLE_NAME = 'client';

    public function get($clientId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $clientSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $clientId);
        $client = ClassCreator::get(Client::class, $clientSql ? $clientSql->fetch_assoc() : []);

        return $client;
    }

    public function getList()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $clients = [];
        $productSql = $connection->select(self::TABLE_NAME);
        $clientsArray = $productSql->fetch_all(MYSQLI_ASSOC);

        foreach ($clientsArray as $clientArray) {
            $clients[] = ClassCreator::get(Client::class, $clientArray);
        }

        return $clients;
    }

    public function save($data)
    {
        /** @var Client $client */
        $client = ClassCreator::get(Client::class, $data);
        $client->save();
    }
}
