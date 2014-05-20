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

    public function noticiaAction(Request $request)
    {
        // Formulario de buscador de artículos
        $formBuscarArticulo = $this->createForm(new BusquedaArticulosType());

        // Servicio de búsqueda y carga de artículos de la base de datos
        $buscador = $this->get('articulos_buscador');

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario  de búqueda de artículos
            if ($request->request->has($formBuscarArticulo->getName())) {
                // handle the first form
                $formBuscarArticulo->handleRequest($request);
         
                if ($formBuscarArticulo->isValid()) {

                    // Se redirige el sitio a la lista de artículos que se quieren buscar pasados por GET
                    return $this->redirect($buscador->generarLink(
                        $formBuscarArticulo["categorias"]->getData(), // Categoría establecida
                        $formBuscarArticulo["otro"]->getData(), // Búsqueda en nombre y descripción de cada artículo
                        $formBuscarArticulo["proveedor"]->getData() // Proveedor que se busca
                    ));
                }
            }
        }

        return $this->render('NWPrincipalBundle:Default:noticia.html.twig', array(
            'formBuscarArticulo' => $formBuscarArticulo->createView()
        ));
    }

    public function listaArticulosAction(Request $request)
    {
        // Formulario de buscador de artículos
        $formBuscarArticulo = $this->createForm(new BusquedaArticulosType());

        // Servicio de búsqueda y carga de artículos de la base de datos
        $buscador = $this->get('articulos_buscador');

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario  de búqueda de artículos
            if ($request->request->has($formBuscarArticulo->getName())) {
                // handle the first form
                $formBuscarArticulo->handleRequest($request);
         
                if ($formBuscarArticulo->isValid()) {

                    // Se redirige el sitio a la lista de artículos que se quieren buscar pasados por GET
                    return $this->redirect($buscador->generarLink(
                        $formBuscarArticulo["categorias"]->getData(), // Categoría establecida
                        $formBuscarArticulo["otro"]->getData(), // Búsqueda en nombre y descripción de cada artículo
                        $formBuscarArticulo["proveedor"]->getData() // Proveedor que se busca
                    ));
                }
            }
        }
        // Si se quiere cargar un listado de artículos por categoría o búsqueda
        else if ('GET' === $request->getMethod()){

            // Checar si se quieren cargar los artículos de una búsqueda
            $esBusquedaAticulo = strpos($this->getRequest()->getPathInfo(), "/busqueda/");

            if($esBusquedaAticulo)
            {
                $buscar = str_replace ("/articulos/busqueda/", "", $this->getRequest()->getPathInfo());
                $buscar = str_replace ("%20", " ", $buscar);

                $resultados = $buscador->articulosPorCoincidencia($buscar);
            }
            else
            {
                // Obtener el nombre de la categoría
                $catName = str_replace ("/articulos/", "", $this->getRequest()->getPathInfo());
                $catName = str_replace ("%20", " ", $catName);

                $resultados = $buscador->articulosPorCategoria($catName);
            }
        }

        // Se muestran todos los artículos encontrados
        return $this->render('NWPrincipalBundle:Default:resultados.html.twig', array(
            'formBuscarArticulo' => $formBuscarArticulo->createView(),
            'resultados' =>  $resultados,
        ));
        
    }

    public function empresaAction()
    {
        return $this->render('NWPrincipalBundle:Default:empresa.html.twig');
    }

}