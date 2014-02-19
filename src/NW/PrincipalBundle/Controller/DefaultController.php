<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

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

    public function changePassAction()
    {
        // Si todo funcionó correctamente, se le muestra al usuario la página de loggeo
        $request = $this->getRequest();
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        }
        else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        // Se renderiza la págia de loggeo general para volver a entrar con la nueva contraseña
        return $this->render(
            'NWPrincipalBundle:Default:changePass.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
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