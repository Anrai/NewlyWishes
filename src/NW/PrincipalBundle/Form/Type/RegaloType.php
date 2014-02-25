<?php
namespace NW\PrincipalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegaloType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('regalo', 'text');
        $builder->add('descripcion', 'textarea');
        $builder->add('precioTotal', 'integer');
        $builder->add('absorberComision', 'checkbox', array('required'  => false));
        $builder->add('cantidad', 'integer');
        $builder->add('horcruxes', 'integer');
        $builder->add('categoria', 'choice', array('choices' => array(
			'1' => 'Muebles',
			'2' => 'Electrodomésticos',
			'3' => 'Viajes',
			), 'multiple'  => false,));
        $builder->add('Agregar', 'submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'regalo';
    }
}