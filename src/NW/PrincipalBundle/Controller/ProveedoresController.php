<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NW\PrincipalBundle\Form\Type\EdicionProveedorType;

use NW\UserBundle\Entity\registroproveedores;

class ProveedoresController extends Controller
{
    public function micuentaAction(Request $request)
    {
        // Obtener usuario y proveedor
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        // Formulario de edición de datos del proveedor
        $formProveedor = $this->createForm(new EdicionProveedorType());

        // Formulario de cambio de contraseña
        $form=$this->createFormBuilder()
            ->add('oldPass', 'password')
            ->add('newPass', 'password')
            ->add('Cambiar', 'submit')
            ->getForm();

        // No se ha actualizado la contraseña
        $statusForm=false;

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
 
            // ¿El formulario que se envió es el de cambio de contraseña?
            if ($request->request->has($form->getName())) {
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
            }

            // ¿El formulario que se envió es el de edición de los datos del proveedor?
            else if ($request->request->has($formProveedor->getName())) {

                // handle the second form
                $formProveedor->handleRequest($request);
         
                if ($formProveedor->isValid()) {

                    // Recuperando datos del proveedor
                    $ProveedorNew = $formProveedor->getData();

                    // Agregando datos del proveedor
                    $estadoProveedorNew=$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($formProveedor["estado"]->getData());
                    
                    $proveedorObject->setTipoPersona($formProveedor["tipoPersona"]->getData());
                    $proveedorObject->setNombreRazon($formProveedor["nombreRazon"]->getData());
                    $proveedorObject->setApellidoPaterno($formProveedor["apellidoPaterno"]->getData());
                    $proveedorObject->setApellidoMaterno($formProveedor["apellidoMaterno"]->getData());
                    $proveedorObject->setRfc($formProveedor["rfc"]->getData());
                    $proveedorObject->setEMail($formProveedor["email"]->getData());
                    $proveedorObject->setLada($formProveedor["lada"]->getData());
                    $proveedorObject->setTelefono($formProveedor["telefono"]->getData());
                    $proveedorObject->setCelular($formProveedor["celular"]->getData());
                    $proveedorObject->setDireccion($formProveedor["direccion"]->getData());
                    $proveedorObject->setEstados($estadoProveedorNew);
                    $proveedorObject->setCiudad($formProveedor["ciudad"]->getData());
                    $proveedorObject->setCp($formProveedor["cp"]->getData());

                    // Persistiendo los datos en la base de datos
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($proveedorObject);
                    $em->flush();
                }
            }
        }

         // Datos del proveedor
        $proveedor['tipoPersona']=$proveedorObject->getTipoPersona();
        $proveedor['nombre']=$proveedorObject->getNombreRazon();

        if ($proveedor['tipoPersona']==='fisica')
        {
             $proveedor['nombre']=$proveedorObject->getNombreRazon().' '.$proveedorObject->getApellidoPaterno().' '.$proveedorObject->getApellidoMaterno();
        }

        $proveedor['cuenta']=$proveedorObject->getId();
        $proveedor['tipoPersona']=$proveedorObject->getTipoPersona();
        $proveedor['rfc']=$proveedorObject->getRfc();
        $proveedor['email']=$proveedorObject->getEmail();
        $proveedor['lada']=$proveedorObject->getLada();
        $proveedor['telefono']=$proveedorObject->getTelefono();
        $proveedor['celular']=$proveedorObject->getCelular();
        $proveedor['direccion']=$proveedorObject->getDireccion();
        $proveedor['estado']=$proveedorObject->getEstados()->getEstado();
        $proveedor['ciudad']=$proveedorObject->getCiudad();
        $proveedor['cp']=$proveedorObject->getCp();
        // Fin de datos del proveedor

        return $this->render('NWPrincipalBundle:Proveedores:micuenta.html.twig', array(
            'form' => $form->createView(),
            'formProveedor' => $formProveedor->createView(),
            'proveedor' => $proveedor,
            'statusForm' => $statusForm
        ));
    }

    public function misproductosAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misproductos.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misbannersAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misbanners.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misanunciosAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misanuncios.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function misresenasAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:misresenas.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miestadodecuentaAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miestadodecuenta.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miscodigosAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miscodigos.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function miinformacionbancariaAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:miinformacionbancaria.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }

    public function tutorialesAction()
    {
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        return $this->render('NWPrincipalBundle:Proveedores:mtutoriales.html.twig', array(
            'proveedor' => $proveedor,
        ));
    }
}