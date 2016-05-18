<?php

namespace RocKordier\Bundle\FestivalWarehouseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class WarehouseType
 * @package RocKordier\Bundle\FestivalWarehouseBundle\Form\Type
 */
class WarehouseType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text');

        parent::buildForm($builder, $options);
    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $options = array(
            'data_class'         => 'RocKordier\Bundle\FestivalWarehouseBundle\Entity\Warehouse',
            'intention'          => 'warehouse',
            'cascade_validation' => true,
        );

        $resolver->setDefaults($options);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rockordier_warehouse_warehouse';
    }
}
