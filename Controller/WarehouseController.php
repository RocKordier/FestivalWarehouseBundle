<?php

namespace RocKordier\Bundle\FestivalWarehouseBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class WarehouseController
 * @package RaB\Bundle\WarehouseBundle\Controller
 */

/**
 * Class WarehouseController
 * @package RaB\Bundle\WarehouseBundle\Controller
 */
class WarehouseController extends Controller
{
    /**
     * @Route("/", name="rockordier_festivalwarehouse_index")
     * @Template
     * @AclAncestor("rockordier_festivalwarehouse_view")
     *
     * @return array
     */
    public function indexAction()
    {
        return ['gridName' => 'warehouse-grid'];
    }
}