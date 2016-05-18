<?php

namespace RocKordier\Bundle\FestivalWarehouseBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RocKordier\Bundle\FestivalWarehouseBundle\Entity\Warehouse;
use RocKordier\Bundle\FestivalWarehouseBundle\Entity\Manager\WarehouseManager;

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
     * @Route("/", name="rockordier_warehouse_index")
     * @Template
     * @AclAncestor("rockordier_warehouse_view")
     *
     * @return array
     */
    public function indexAction()
    {
        $this->get('doctrine.orm.entity_manager')->getRepository('FestivalWarehouseBundle:Warehouse');

        return ['gridName' => 'warehouse-grid'];
    }

    /**
     * @Route("/view/{id}", name="rockordier_warehouse_view", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Acl(
     *      id="rockordier_warehouse_view",
     *      type="entity",
     *      permission="VIEW",
     *      class="FestivalWarehouseBundle:Warehouse"
     * )
     * @Template
     *
     * @param Warehouse $warehouse
     * @return array
     */
    public function viewAction(Warehouse $warehouse)
    {
        return [ 'entity' => $warehouse ];
    }

    /**
     * @Route("/create", name="rockordier_warehouse_create")
     * @Template("FestivalWarehouseBundle:Warehouse:update.html.twig")
     * @Acl(
     *      id="rockordier_warehouse_create",
     *      type="entity",
     *      permission="CREATE",
     *      class="FestivalWarehouseBundle:Warehouse"
     * )
     * @return array
     */
    public function createAction()
    {
        $entity = $this->getManager()->createEntity();

        return $this->update($entity);
    }

    /**
     * @Route("/update/{id}", name="rockordier_warehouse_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     * @Acl(
     *      id="rockordier_warehouse_update",
     *      type="entity",
     *      permission="EDIT",
     *      class="FestivalWarehouseBundle:Warehouse"
     * )
     *
     * @param Warehouse $warehouse
     * @return array
     */
    public function updateAction(Warehouse $warehouse)
    {
        return $this->update($warehouse);
    }

    /**
     * @param Warehouse|null $entity
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function update(Warehouse $entity = null)
    {
        if (!$entity) {
            $entity = $this->getManager()->createEntity();
        }

        if($this->get('rockordier.warehouse.form.handler.warehouse')->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('rockordier.warehouse.controller.warehouse.message.saved')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'rockordier_warehouse_update', 'parameters' => ['id' => $entity->getId()]],
                ['route' => 'rockordier_warehouse_index'],
                $entity
            );
        }

        return array(
            'entity'        => $entity,
            'form'          => $this->get('rockordier.warehouse.form.warehouse')->createView(),
        );
    }

    /**
     * @return WarehouseManager
     */
    protected function getManager()
    {
        return $this->get('rockordier.warehouse.manager');
    }
}
