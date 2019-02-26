<?php
namespace LovelySpace\Model;

use ClassCreator;

class ProductStockRepository
{
    public function get($productStockId)
    {
        /** @var \LovelySpace\Model\Resource\ProductStock $productStockResource */
        $productStockResource = ClassCreator::get(\LovelySpace\Model\Resource\ProductStock::class);

        $productStockArray = $productStockResource->getModel($productStockId);
        $productStock = ClassCreator::get(ProductStock::class, $productStockArray);

        return $productStock;
    }

    public function getList()
    {
        /** @var \LovelySpace\Model\Resource\ProductStock $productStockResource */
        $productStockResource = ClassCreator::get(\LovelySpace\Model\Resource\ProductStock::class);
        $productStocksArray = $productStockResource->getModelsArray();

        $productsStocks = [];
        foreach ($productStocksArray as $productStockArray) {
            $productsStocks[] = ClassCreator::get(ProductStock::class, $productStockArray);
        }

        return $productsStocks;
    }

    public function save($data)
    {
        /** @var ProductStock $productStock */
        $productStock = ClassCreator::get(ProductStock::class, $data);
        $productStock->save();
    }
}
