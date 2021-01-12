<?php
namespace LovelySpace\Model\Product;

use ClassCreator;

class ProductStockRepository
{
    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\Product\ProductStock $productStockResource */
        $productStockResource = ClassCreator::get(\LovelySpace\Model\Resource\Product\ProductStock::class);
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
