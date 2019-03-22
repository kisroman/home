<?php

namespace LovelySpace\Model\Spending;

use ClassCreator;

class SpendingRepository
{
    public function get($id)
    {
        /** @var \LovelySpace\Model\Resource\Spending\Spending $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\Spending\Spending::class);
        $shop = ClassCreator::get(Spending::class, $resource->getModel($id));

        return $shop;
    }

    public function getList()
    {
        $models = [];
        /** @var \LovelySpace\Model\Resource\Spending\Spending $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\Spending\Spending::class);
        $modelsArray = $resource->getModelsArray();

        foreach ($modelsArray as $modelArray) {
            $models[] = ClassCreator::get(Spending::class, $modelArray);
        }

        return $models;
    }

    public function save($data)
    {
        /** @var Spending $model */
        $model = ClassCreator::get(Spending::class, $data);
        $model->save();
    }
}
