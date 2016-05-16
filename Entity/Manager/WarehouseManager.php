<?php

namespace RocKordier\Bundle\FestivalWarehouseBundle\Entity\Manager;

use Doctrine\Common\Persistence\ObjectManager;

use RocKordier\Bundle\FestivalWarehouseBundle\Entity\Warehouse;

/**
 * Class WarehouseManager
 * @package RocKordier\Bundle\FestivalWarehouseBundle\Entity\Manager
 */
class WarehouseManager
{
    /**
     * @var Warehouse
     */
    protected $entityClass;

    /**
     * @var ObjectManager
     */
    protected $om;


    /**
     * WarehouseManager constructor.
     * @param Warehouse     $entityClass
     * @param ObjectManager $om
     */
    public function __construct($entityClass, ObjectManager $om)
    {
        $this->entityClass = $entityClass;
        $this->om = $om;
    }

    /**
     * @return Warehouse
     */
    public function createEntity()
    {
        return new Warehouse();
    }

    /**
     * @param Warehouse $warehouse
     */
    public function saveEntity($warehouse)
    {
        $this->om->persist($warehouse);
        $this->om->flush();
    }
}
