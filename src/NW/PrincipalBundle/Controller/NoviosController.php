<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NoviosController extends Controller
{
    public function indexAction()
    {
        return $this->render('NWPrincipalBundle:Novios:index.html.twig');
    }
	
	public function nuestraBodaAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestra-boda.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestroCalendarioAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestro-calendario.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestroChecklistAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestro-checklist.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestraMesaDeRegalosAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestra-mesa-de-regalos.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestraListaDeInvitadosAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestra-lista-de-invitados.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestraCuentaAction(Request $request)
    {
        // Obtener usuario y novios
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        // Datos de la novia para plantilla
        $noviaInfo['nombreCompleto']=$novia->getNombre().' '.$novia->getSNombre().' '.$novia->getAPaterno().' '.$novia->getAMaterno();
        $noviaInfo['email']=$novia->getEMail();
        $noviaInfo['lada']=$novia->getLada();
        $noviaInfo['telefono']=$novia->getTelefono();
        $noviaInfo['celular']=$novia->getCelular();
        $noviaInfo['direccion']=$novia->getDireccion();
        $noviaInfo['estado']=$novia->getEstados()->getEstado();
        $noviaInfo['ciudad']=$novia->getCiudad();
        $noviaInfo['cp']=$novia->getCp();

        // Datos del novio para plantilla
        $novioInfo['nombreCompleto']=$novio->getNombre().' '.$novio->getSNombre().' '.$novio->getAPaterno().' '.$novio->getAMaterno();
        $novioInfo['nombreCompleto']=$novio->getNombre().' '.$novio->getSNombre().' '.$novio->getAPaterno().' '.$novio->getAMaterno();
        $novioInfo['email']=$novio->getEMail();
        $novioInfo['lada']=$novio->getLada();
        $novioInfo['telefono']=$novio->getTelefono();
        $novioInfo['celular']=$novio->getCelular();
        $novioInfo['direccion']=$novio->getDireccion();
        $novioInfo['estado']=$novio->getEstados()->getEstado();
        $novioInfo['ciudad']=$novio->getCiudad();
        $novioInfo['cp']=$novio->getCp();

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
            // Ya se actualizó la contraseña
            $statusForm=true;
        }

        // Renderear la plantilla con la información necesaria
        return $this->render('NWPrincipalBundle:Novios:nuestra-cuenta.html.twig', array(
            'form' => $form->createView(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'noviaInfo' => $noviaInfo,
            'novioInfo' => $novioInfo,
            'statusForm' => $statusForm
        ));
    }
	
	public function nuestraInformacionBancariaAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestra-informacion-bancaria.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }
	
	public function nuestrasComprasAction()
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        return $this->render('NWPrincipalBundle:Novios:nuestras-compras.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
        ));
    }

  
}