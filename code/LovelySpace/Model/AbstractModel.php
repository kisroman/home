<?php

namespace LovelySpace\Model;

use ClassCreator;
use Framework\DataObject;

abstract class AbstractModel extends DataObject
{
    /**
     * @var \LovelySpace\Model\Resource\AbstractModel
     */
    protected $resource;

    protected function initResource($className)
    {
        $this->resource = ClassCreator::get($className);
    }

    public function save()
    {
        return $this->resource->save($this);
    }
}
