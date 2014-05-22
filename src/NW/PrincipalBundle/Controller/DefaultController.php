<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use NW\PrincipalBundle\Form\Type\BusquedaArticulosType;
use NW\PrincipalBundle\Form\Type\NuevaResenaType;
use NW\PrincipalBundle\Form\Type\BuscarNoviosType;

use NW\PrincipalBundle\Entity\Resena;

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
            $esBusquedaArticulo = strpos($this->getRequest()->getPathInfo(), "/busqueda/");

            if($esBusquedaArticulo)
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

    public function proveedorAction(Request $request)
    {
        // Manejador de entidades
        $em = $this->getDoctrine()->getEntityManager();

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
            // Formulario de nueva Reseña
            if ($request->request->has('nuevaResena')) {
                // handle the first form
                $formNuevaResena = $this->createForm(new nuevaResenaType());
                $formNuevaResena->handleRequest($request);
         
                if ($formNuevaResena->isValid()) {

                    // Se obtienen los datos del proveedor
                    $proveedorId = $formNuevaResena['proveedorId']->getData();
                    $proveedorEntity = $em->getRepository('NWUserBundle:registroproveedores');
                    $proveedorObj = $proveedorEntity->find($proveedorId);
                    $proveedorNombreComercial = $proveedorObj->getNombreComercial();

                    // Se crea una nueva reseña
                    $newResenaObj = new Resena();
                    $newResenaObj->setTitulo($formNuevaResena['titulo']->getData());
                    $newResenaObj->setResena($formNuevaResena['resena']->getData());
                    $newResenaObj->setPuntuacion($formNuevaResena['puntuacion']->getData());
                    $newResenaObj->setProveedor($proveedorObj);

                    // Se persiste la nueva reseña a la base de datos
                    $em->persist($newResenaObj);
                    $em->flush();

                    // Se regresa a la página del proveedor
                    return $this->redirect($this->generateURL('nw_principal_proveedor').'/'.$proveedorNombreComercial);
                }
            }
        }
        // Si se quiere cargar un proveedor específico
        else if ('GET' === $request->getMethod()){

            // Checar si se quieren cargar los artículos de una búsqueda
            $esBusquedaProveedor = strpos($this->getRequest()->getPathInfo(), "/busqueda/");

            if($esBusquedaProveedor)
            {
                $buscar = str_replace ("/proveedor/busqueda/", "", $this->getRequest()->getPathInfo());
                $buscar = str_replace ("%20", " ", $buscar);

                $resultados = $buscador->proveedoresPorCoincidencia($buscar);

                return $this->render('NWPrincipalBundle:Default:proveedoresBusqueda.html.twig', array(
                    'formBuscarArticulo' => $formBuscarArticulo->createView(),
                    'resultados' => $resultados,
                ));
            }
            else
            {
                // Obtener el nombre del proveedor
                $provName = str_replace ("/proveedor/", "", $this->getRequest()->getPathInfo());
                $provName = str_replace ("%20", " ", $provName);

                $proveedorArray = $buscador->proveedorPorNombreComercial($provName);

                $proveedorEntity = $em->getRepository('NWUserBundle:registroproveedores');
                $proveedorObj = $proveedorEntity->findOneBy(array('nombreComercial' => $provName));
                $proveedorUsuarioId = $proveedorObj->getUsuarioId();

                // Obteniendo la lista de artículos en un arreglo de objetos
                $articulos = $em->getRepository('NWPrincipalBundle:Articulos')->findBy(array('usuarioId' => $proveedorUsuarioId));

                // Convirtiendo los resultados en arrays
                foreach($articulos as $index=>$value)
                {
                    $objetoenArray=$articulos[$index]->getValues();
                    $articulos[$index]=$objetoenArray;

                    foreach($articulos[$index]['fotos'] as $indice=>$valor)
                    {
                        $objeto2enArray=$articulos[$index]['fotos'][$indice]->getValues(false);
                        $articulos[$index]['fotos'][$indice]=$objeto2enArray;
                    }
                }

                // Servicio de Reseñas
                $resenasService = $this->get('resenas_service');

                // Obtener toda la información de las reseñas del proveedor
                $resenas = $resenasService->getResenas($proveedorObj->getId());

                // Formulario de nueva reseña (si es necesaria)
                $formNuevaResenaData = new Resena();
                $formNuevaResenaData->setProveedorId($proveedorObj->getId());
                $formNuevaResena = $this->createForm(new nuevaResenaType(), $formNuevaResenaData);

                return $this->render('NWPrincipalBundle:Default:proveedor.html.twig', array(
                    'formBuscarArticulo' => $formBuscarArticulo->createView(),
                    'formNuevaResena' => $formNuevaResena->createView(),
                    'proveedor' => $proveedorArray,
                    'articulos' => $articulos,
                    'resenas' => $resenas,
                ));
            }

        }

    }

    public function buscarnoviosAction(Request $request)
    {
        // Formulario de búsqueda de novios
        $formBuscarNovios = $this->createForm(new BuscarNoviosType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario de búqueda de novios
            if ($request->request->has($formBuscarNovios->getName())) {
                // handle the first form
                $formBuscarNovios->handleRequest($request);
         
                if ($formBuscarNovios->isValid()) {

                    // Servicio de Búsqueda de novios
                    $busquedaNoviosService = $this->get('busqueda_novios_service');

                    // Resultados de la búsqueda de novios
                    $resultados = $busquedaNoviosService->buscarNovios($formBuscarNovios->getData());

                    return $this->render('NWPrincipalBundle:Default:noviosencontrados.html.twig', array(
                        'resultados' => $resultados,
                    ));
                }
            }
        }

        return $this->render('NWPrincipalBundle:Default:buscarnovios.html.twig', array(
            'formBuscarNovios' => $formBuscarNovios->createView(),
        ));
    }

    public function mesaDeRegalosAction($usuarioId, Request $request)
    {
        // Servicio de funciones para la mesa de regalos
        $MRService = $this->get('mesa_regalos_service');

        $noviaYnovio = $MRService->getNovios($usuarioId); // Obtener los nombre de los novios
        $formFiltrar = $MRService->getFormFiltrar(); // Formulario para filtrar artículos

        // Sin criterios de búsqueda
        $categoria = '';
        $precioArticulo = '';
        $precioParte = '';

        // Recuperando formulario
        if('POST' === $request->getMethod()) {
            $formFiltrar->handleRequest($request);
            if($formFiltrar->isValid()) {
                // Cambian los criterios de búsqueda
                $categoria = $formFiltrar['categoria']->getData();
                $precioArticulo = $formFiltrar['precioArticulo']->getData();
                $precioParte = $formFiltrar['precioParte']->getData();
            }
        }

        $articulos = $MRService->getMesaRegalos($usuarioId, $categoria, $precioArticulo, $precioParte); // Obtener artículos de la mesa de regalos filtrada
        
        return $this->render('NWPrincipalBundle:Default:mesaderegalos.html.twig', array(
            'formFiltrar' => $formFiltrar->createView(),
            'noviaYnovio' => $noviaYnovio,
            'articulos' => $articulos,
        ));
    }

}