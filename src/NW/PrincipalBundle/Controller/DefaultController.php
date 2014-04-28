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
                        $ArticulosEntidad = $this->getDoctrine()->getRepository('NWPrincipalBundle:Articulos');
                        $resultados = $ArticulosEntidad->findBy(array('categoriaId' => $formBuscarArticulo["categorias"]->getData()));
                    }
                    else if ($formBuscarArticulo["otro"]->getData())
                    {
                        // Buscar según otro
                    }
                    else if ($formBuscarArticulo["proveedor"]->getData())
                    {
                        // Buscar según otro
                    }

                    // Convirtiendo los resultados en arrays
                    foreach($resultados as $index=>$value)
                    {
                        $objetoenArray=$resultados[$index]->getValues();
                        $resultados[$index]=$objetoenArray;

                        foreach($resultados[$index]['fotos'] as $indice=>$valor)
                        {
                            $objeto2enArray=$resultados[$index]['fotos'][$indice]->getValues();
                            $resultados[$index]['fotos'][$indice]=$objeto2enArray;
                        }
                    }

                    // Se muestran todos los artículos encontrados
                    return $this->render('NWPrincipalBundle:Default:resultados.html.twig', array(
                        'resultados' =>  $resultados,
                    ));
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

    public function listaArticulosAction(Request $request)
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
                        //$ArticulosEntidad = $this->getDoctrine()->getRepository('NWPrincipalBundle:Articulos');
                        //$resultados = $ArticulosEntidad->findBy(array('categoriaId' => $formBuscarArticulo["categorias"]->getData()));
                        
                        $catEntity = $this->getDoctrine()->getRepository('NWPrincipalBundle:Categorias');
                        $catObj = $catEntity->find($formBuscarArticulo["categorias"]->getData());
                        $catName = $catObj->getNombre();

                        // Quitar acentos de la categoría
                        $no_permitidas = array ('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ');
                        $si_permitidas = array ('a','e','i','o','u','A','E','I','O','U','n','N');
                        $catName = str_replace($no_permitidas, $si_permitidas, $catName);

                        return $this->redirect($this->generateUrl('nw_principal_articulos_catname')."/".$catName);
                    }
                    else if ($formBuscarArticulo["otro"]->getData())
                    {
                        // Buscar según otro
                    }
                    else if ($formBuscarArticulo["proveedor"]->getData())
                    {
                        // Buscar según proveedor
                    }

                    // Convirtiendo los resultados en arrays
                    /*foreach($resultados as $index=>$value)
                    {
                        $objetoenArray=$resultados[$index]->getValues();
                        $resultados[$index]=$objetoenArray;

                        foreach($resultados[$index]['fotos'] as $indice=>$valor)
                        {
                            $objeto2enArray=$resultados[$index]['fotos'][$indice]->getValues();
                            $resultados[$index]['fotos'][$indice]=$objeto2enArray;
                        }
                    }*/

                    // Se muestran todos los artículos encontrados
                    return new Response("Ola k ase");

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
        // Si se quiere cargar el listado de artículos
        else if ('GET' === $request->getMethod()){

            // Obtener el nombre de la categoría
            $catName = str_replace ("/articulos/", "", $this->getRequest()->getPathInfo());
            $catName = str_replace ("%20", " ", $catName);

            // Obteniendo entidades de categorías y artículos
            $CategoriasEntidad = $this->getDoctrine()->getRepository('NWPrincipalBundle:Categorias');
            $ArticulosEntidad = $this->getDoctrine()->getRepository('NWPrincipalBundle:Articulos');

            // Obteniendo el iD 
            $catObj = $CategoriasEntidad->findOneBy(array('nombre' => $catName));

            // ¿Existe la categoría?
            if(is_object($catObj))
            {
                $resultados = $ArticulosEntidad->findBy(array('categoriaId' => $catObj->getId()));

                // Convirtiendo los resultados en arrays
                foreach($resultados as $index=>$value)
                {
                    $objetoenArray=$resultados[$index]->getValues();
                    $resultados[$index]=$objetoenArray;

                    foreach($resultados[$index]['fotos'] as $indice=>$valor)
                    {
                        $objeto2enArray=$resultados[$index]['fotos'][$indice]->getValues();
                        $resultados[$index]['fotos'][$indice]=$objeto2enArray;
                    }
                }
            }
            else
            {
                $resultados = false;
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