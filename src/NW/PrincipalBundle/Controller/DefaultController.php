<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use NW\PrincipalBundle\Form\Type\BusquedaArticulosType;

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

    public function noticiasAction(Request $request)
    {
        // Formulario de buscador de artículos
        $formBuscarArticulo = $this->createForm(new BusquedaArticulosType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario  de búqueda de artículos
            if ($request->request->has($formBuscarArticulo->getName())) {
                // handle the first form
                $formBuscarArticulo->handleRequest($request);
         
                if ($formBuscarArticulo->isValid()) {

                    if($formBuscarArticulo["categorias"]->getData())
                    {
                        // Buscar según categoría
                    }
                    else if ($formBuscarArticulo["otro"]->getData())
                    {
                        // Buscar según otro
                    }

                    // Recuperando datos del formulario
                        /*
                    $formBuscarArticulo["categorias"]->getData()
                    $formBuscarArticulo["estado"]->getData()
                    $formBuscarArticulo["categorias"]->getData()
                    $formBuscarArticulo["otro"]->getData()
                    $formBuscarArticulo["proveedor"]->getData()*/

                    //Contenido
                }
            }
            // Formulario2
            /*
            else if ($request->request->has($form->getName())) {
                // handle the second form
                $form->handleRequest($request);
         
                if ($form->isValid()) {
        
                    //Contenido
                }
            }*/
        }

        return $this->render('NWPrincipalBundle:Default:noticias.html.twig', array(
            'formBuscarArticulo' => $formBuscarArticulo->createView(),
        ));
    }

    public function noticiaAction()
    {
        return $this->render('NWPrincipalBundle:Default:noticia.html.twig');
    }

    public function resultadosAction()
    {
        return $this->render('NWPrincipalBundle:Default:resultados.html.twig');
    }

    public function empresaAction()
    {
        return $this->render('NWPrincipalBundle:Default:empresa.html.twig');
    }

}