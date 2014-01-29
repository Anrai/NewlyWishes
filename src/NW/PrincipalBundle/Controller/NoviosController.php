<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NoviosController extends Controller
{
    public function indexAction()
    {
        return $this->render('NWPrincipalBundle:Novios:index.html.twig');
    }
	
	public function nuestraBodaAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestra-boda.html.twig');
    }
	
	public function nuestroCalendarioAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestro-calendario.html.twig');
    }
	
	public function nuestroChecklistAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestro-checklist.html.twig');
    }
	
	public function nuestraMesaDeRegalosAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestra-mesa-de-regalos.html.twig');
    }
	
	public function nuestraListaDeInvitadosAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestra-lista-de-invitados.html.twig');
    }
	
	public function nuestraCuentaAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestra-cuenta.html.twig');
    }
	
	public function nuestraInformacionBancariaAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestra-informacion-bancaria.html.twig');
    }
	
	public function nuestrasComprasAction()
    {
        return $this->render('NWPrincipalBundle:Novios:nuestras-compras.html.twig');
    }

  
}