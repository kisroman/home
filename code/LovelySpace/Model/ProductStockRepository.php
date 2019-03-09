<?php
namespace LovelySpace\Model;

use ClassCreator;

class ProductStockRepository
{
    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\ProductStock $productStockResource */
        $productStockResource = ClassCreator::get(\LovelySpace\Model\Resource\ProductStock::class);
        $productStocksArray = $productStockResource->getModelsArray();

        $productsStocks = [];
        foreach ($productStocksArray as $productStockArray) {
            $productsStocks[$productStockArray['product_id']] = ClassCreator::get(
                ProductStock::class,
                $productStockArray
            );
        }

        return $productsStocks;
    }
}
