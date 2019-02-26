<?php
namespace LovelySpace\Model;

use ClassCreator;

class ProductStockManager
{
    public function getProductStocksByProductId()
    {
        /** @var ProductStockRepository $productStockRepository */
        $productStockRepository = ClassCreator::get(ProductStockRepository::class);
        $productsStocks = $productStockRepository->getList();

        $stocksByProductId = [];
        /** @var ProductStock $productsStock */
        foreach ($productsStocks as $productsStock) {
            if (isset($stocksByProductId[$productsStock->getProductId()])) {
                $stock = $stocksByProductId[$productsStock->getProductId()];
                if (isset($stock['qty'])) {
                    $stock['qty'] += $productsStock->getQty();
                } else {
                    $stock['qty'] = $productsStock->getQty();
                }

                if (isset($stock['total'])) {
                    $stock['total'] += $productsStock->getTotal();
                } else {
                    $stock['total'] = $productsStock->getTotal();
                }

                $stocksByProductId[$productsStock->getProductId()] = $stock;
            } else {
                $stocksByProductId[$productsStock->getProductId()]['qty'] = $productsStock->getQty();
                $stocksByProductId[$productsStock->getProductId()]['total'] = $productsStock->getTotal();
            }
        }

        return $stocksByProductId;
    }
}
