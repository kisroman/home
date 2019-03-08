<?php

namespace LovelySpace\Model;

use ClassCreator;

class ShopRepository
{
    public function get($shopId)
    {
        /** @var \LovelySpace\Model\Resource\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop::class);
        $shop = ClassCreator::get(Client::class, $shopResource->getModel($shopId));

        return $shop;
    }

    public function getList()
    {
        $shops = [];
        /** @var \LovelySpace\Model\Resource\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop::class);
        $shopsArray = $shopResource->getModelsArray();

        usort($shopsArray, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        foreach ($shopsArray as $shopArray) {
            $shops[] = ClassCreator::get(Client::class, $shopArray);
        }

        return $shops;
    }

    public function save($data)
    {
        /** @var Shop $shop */
        $shop = ClassCreator::get(Shop::class, $data);
        $shop->save();
    }

    public function getNameById($id)
    {
        /** @var \LovelySpace\Model\Resource\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop::class);

        return $shopResource->getNameById($id);
    }

}
