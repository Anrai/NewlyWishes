<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NWPrincipalBundle::index.html.twig');
    }

    public function funcionamientoAction()
    {
        return $this->render('NWPrincipalBundle:Default:funcionamiento.html.twig');
    }

    public function registronoviosAction()
    {
        return $this->render('NWPrincipalBundle:Default:registronovios.html.twig');
    }

    public function planesAction()
    {
        return $this->render('NWPrincipalBundle:Default:planes.html.twig');
    }


    public function edicion1Action()
    {
        return $this->render('NWPrincipalBundle:Default:edicion1.html.twig');
    }

    public function edicion2Action()
    {
        return $this->render('NWPrincipalBundle:Default:edicion2.html.twig');
    }

    public function edicion3Action()
    {
        return $this->render('NWPrincipalBundle:Default:edicion3.html.twig');
    }
}