<?php
// src/NW/UserBundle/Form/Type/RegistroType.php
namespace NW\UserBundle\Form\Type;

use NW\UserBundle\Form\Type\NoviaType;
use NW\UserBundle\Form\Type\NovioType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
 
class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Se cargan los formularios para el novio y la novia
        $builder->add('novias', new NoviaType());
        $builder->add('novios', new NovioType());

        // Se genera el formulario para el registro de usuarios
        $builder->add('userName', 'text', array('mapped' => false, 'required'  => true));
        $builder->add('userPass', 'password', array('mapped' => false, 'required'  => true));
        $builder->add('mismaDireccion', 'checkbox', array('mapped' => false, 'required'  => false));
        $builder->add('terminosCondiciones', 'checkbox', array('mapped' => false, 'required'  => true));
        $builder->add('terminosPrivacidad', 'checkbox', array('mapped' => false, 'required'  => true));
        $builder->add('aceptar', 'submit');
    }

    public function getName()
    {
        return 'registro';
    }
}