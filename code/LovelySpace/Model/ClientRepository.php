<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ClientRepository
{
    const TABLE_NAME = 'client';

    public function get($clientId)
    {
        /** @var \LovelySpace\Model\Resource\Client $clientResource */
        $clientResource = ClassCreator::get(\LovelySpace\Model\Resource\Client::class);
        $product = ClassCreator::get(Client::class, $clientResource->getModel($clientId));

        return $product;
    }

    public function getList()
    {
        $clients = [];
        /** @var \LovelySpace\Model\Resource\Client $clientResource */
        $clientResource = ClassCreator::get(\LovelySpace\Model\Resource\Client::class);
        $clientsArray = $clientResource->getModelsArray();

        usort($clientsArray, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

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
