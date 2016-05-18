<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 16.02.16
 * Time: 22:21
 */

namespace RocKordier\Bundle\FestivalWarehouseBundle\Form\Handler;

use RocKordier\Bundle\FestivalWarehouseBundle\Entity\Warehouse;
use RocKordier\Bundle\FestivalWarehouseBundle\Entity\Manager\WarehouseManager;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WarehouseHandler
 * @package RocKordier\Bundle\FestivalWarehouseBundle\Form\Handler
 */
class WarehouseHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var WarehouseManager
     */
    protected $manager;

    /**
     * @param FormInterface    $form
     * @param Request          $request
     * @param WarehouseManager $manager
     */
    public function __construct(
        FormInterface $form,
        Request $request,
        WarehouseManager $manager
    ) {
        $this->form    = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param  Warehouse $warehouse
     * @return bool True on successfull processing, false otherwise
     */
    public function process(Warehouse $warehouse)
    {
        $this->form->setData($warehouse);

        if (in_array($this->request->getMethod(), array('POST', 'PUT'))) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($warehouse);

                return true;
            }
        }

        return false;
    }

    /**
     * "Success" form handler
     *
     * @param Warehouse $warehouse
     */
    protected function onSuccess(Warehouse $warehouse)
    {
        $this->manager->saveEntity($warehouse);
    }
}
