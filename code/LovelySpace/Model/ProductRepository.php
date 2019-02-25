<?php
namespace LovelySpace\Model;

use ClassCreator;
use Framework\Db\Connection;

class ProductRepository
{
    const TABLE_NAME = 'product';

    public function get($productId)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $productSql = $connection->select(self::TABLE_NAME, '*', 'id=' . $productId);
        $product = ClassCreator::get(Product::class, $productSql ? $productSql->fetch_assoc() : []);

        return $product;
    }

    public function getList()
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);
        $products = [];
        $productSql = $connection->select(self::TABLE_NAME);
        $productsArray = $productSql ? $productSql->fetch_all(MYSQLI_ASSOC) : [];

        foreach ($productsArray as $productArray) {
            $products[] = ClassCreator::get(Product::class, $productArray);
        }

        return $products;
    }

    public function save($data)
    {
        /** @var Connection $connection */
        $connection = ClassCreator::get(Connection::class);

        if (isset($data['id']) && $data['id']) {
            $connection->update(
                self::TABLE_NAME,
                'name = "' . $data['name'] . '", price = ' . $data['price'],
                'id = "' . $data['id'] . '"'
            );
        } else {
            $connection->insert(
                self::TABLE_NAME,
                'null, "' . $data['name'] . '", "' . $data['price'] . '"',
                'id, name, price'
            );
        }
    }
}
