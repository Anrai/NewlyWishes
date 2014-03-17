<?php
namespace NW\PrincipalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticuloType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idInterno', 'text');
        $builder->add('nombre', 'text');
        $builder->add('descripcion', 'text');
        $builder->add('stock', 'integer');
        $builder->add('precio', 'integer');
        $builder->add('precioPromocion', 'integer');
        $builder->add('tamanos', 'text');
        $builder->add('tipo', 'choice', array('choices' => array('Producto' => 'Producto', 'Servicio' => 'Servicio'), 'expanded' => true, 'multiple' => false));
        $builder->add('estatus', 'choice', array('choices' => array(true => 'Activo', false => 'Inactivo'), 'expanded' => true, 'multiple' => false));
        $builder->add('fotos', 'text'); //checar
        $builder->add('terminosCondiciones', 'checkbox', array('mapped' => false, 'required'  => true));
        $builder->add('terminosPrivacidad', 'checkbox', array('mapped' => false, 'required'  => true));
        $builder->add('Agregar', 'submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'articulo';
    }
}