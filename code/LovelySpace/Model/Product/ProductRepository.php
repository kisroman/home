<?php
namespace LovelySpace\Model\Product;

use ClassCreator;
use Framework\Db\Connection;

class ProductRepository
{
    public function get($productId)
    {
        /** @var \LovelySpace\Model\Resource\Product\Product $productResource */
        $productResource = ClassCreator::get(\LovelySpace\Model\Resource\Product\Product::class);
        $product = ClassCreator::get(Product::class, $productResource->getModel($productId));

        return $product;
    }

    public function getList()
    {
        $products = [];
        /** @var \LovelySpace\Model\Resource\Product\Product $productResource */
        $productResource = ClassCreator::get(\LovelySpace\Model\Resource\Product\Product::class);
        $productsArray = $productResource->getModelsArray();

        usort($productsArray, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        foreach ($productsArray as $productArray) {
            $products[] = ClassCreator::get(Product::class, $productArray);
        }

        return $products;
    }

    public function save($data)
    {
        /** @var Product $product */
        $product = ClassCreator::get(Product::class, $data);
        $product->save();
    }
}
