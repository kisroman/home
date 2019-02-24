<?php

namespace LovelySpace\Model;

use ClassCreator;

class Client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $instagramName;

    /**
     * @var string
     */
    private $phone;

    public function __construct($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->instagramName = isset($data['instagram_name']) ? $data['instagram_name'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
    }

    public function save()
    {
        /** @var \LovelySpace\Model\Resource\Client $resource */
        $resource = ClassCreator::get(\LovelySpace\Model\Resource\Client::class);
        $id = $resource->save($this);

        return $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getInstagramName()
    {
        return $this->instagramName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
