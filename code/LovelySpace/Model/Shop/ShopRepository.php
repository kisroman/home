<?php

namespace LovelySpace\Model\Shop;

use ClassCreator;

class ShopRepository
{
    public function get($shopId)
    {
        /** @var \LovelySpace\Model\Resource\Shop\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop\Shop::class);
        $shop = ClassCreator::get(Shop::class, $shopResource->getModel($shopId));

        return $shop;
    }

    public function getList()
    {
        $shops = [];
        /** @var \LovelySpace\Model\Resource\Shop\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop\Shop::class);
        $shopsArray = $shopResource->getModelsArray();

        usort($shopsArray, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        foreach ($shopsArray as $shopArray) {
            $shops[] = ClassCreator::get(Shop::class, $shopArray);
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
        /** @var \LovelySpace\Model\Resource\Shop\Shop $shopResource */
        $shopResource = ClassCreator::get(\LovelySpace\Model\Resource\Shop\Shop::class);

        return $shopResource->getNameById($id);
    }

}
