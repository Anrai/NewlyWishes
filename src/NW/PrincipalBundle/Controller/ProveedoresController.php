<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProveedoresController extends Controller
{
    public function micuentaAction(Request $request)
    {
        // Datos del proveedor
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['tipoPersona']=$proveedorOject->getTipoPersona();
        $proveedor['nombre']=$proveedorOject->getNombreRazon();

        if ($proveedor['tipoPersona']==='moral')
        {
             $proveedor['nombre']=$proveedorOject->getNombreRazon().' '.$proveedorOject->getApellidoPaterno().' '.$proveedorOject->getApellidoMaterno();
        }

        $proveedor['cuenta']=$proveedorOject->getId();
        $proveedor['tipoPersona']=$proveedorOject->getTipoPersona();
        $proveedor['rfc']=$proveedorOject->getRfc();
        $proveedor['email']=$proveedorOject->getEmail();
        $proveedor['lada']=$proveedorOject->getLada();
        $proveedor['telefono']=$proveedorOject->getTelefono();
        $proveedor['celular']=$proveedorOject->getCelular();
        $proveedor['direccion']=$proveedorOject->getDireccion();
        $proveedor['estado']=$proveedorOject->getEstados()->getEstado();
        $proveedor['ciudad']=$proveedorOject->getCiudad();
        $proveedor['cp']=$proveedorOject->getCp();
        // Fin de datos del proveedor

        // Formulario de cambio de contraseña
        $form=$this->createFormBuilder()
            ->add('oldPass', 'password')
            ->add('newPass', 'password')
            ->add('Cambiar', 'submit')
            ->getForm();

        // No se ha actualizado la contraseña
        $statusForm=false;

        // Recuperando datos del formulario de cambio de contraseña
        $form->handleRequest($request);

        if($form->isValid())
        {
            // Codificando la contraseña escrita para después compararla con la original
            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            $encoder_pass = $encoder->encodePassword($form["oldPass"]->getData(), $user->getSalt());

            // Verificar que la contraseña escrita sea correcta
            if($encoder_pass === $user->getPassword())
            {
                // Cambiar contraseña del usuario
                $user->setPlainPassword($form["newPass"]->getData());
                $this->get('fos_user.user_manager')->updateUser($user,false);
                $this->getDoctrine()->getEntityManager()->flush();
                
                // Ya se actualizó la contraseña
                $statusForm=true;
            }            
        }

        return $this->render('NWPrincipalBundle:Proveedores:micuenta.html.twig', array(
            'form' => $form->createView(),
            'proveedor' => $proveedor,
            'statusForm' => $statusForm
        ));
    }

    public function misproductosAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misproductos.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misbannersAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misbanners.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misanunciosAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misanuncios.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misresenasAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misresenas.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miestadodecuentaAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miestadodecuenta.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miscodigosAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miscodigos.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miinformacionbancariaAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miinformacionbancaria.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function tutorialesAction()
    {
        $user=$this->getUser();
        $proveedorOject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorOject->getNombreRazon();
        $proveedor['cuenta']=$proveedorOject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:mtutoriales.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }
}