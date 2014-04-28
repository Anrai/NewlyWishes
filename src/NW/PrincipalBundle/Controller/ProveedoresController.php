<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NW\PrincipalBundle\Form\Type\EdicionProveedorType;
use NW\PrincipalBundle\Form\Type\ArticuloType;
use NW\PrincipalBundle\Form\Type\AnuncioType;
use NW\PrincipalBundle\Form\Type\BannersType;

use NW\PrincipalBundle\Entity\Articulos;
use NW\PrincipalBundle\Entity\FotosArticulos;
use NW\PrincipalBundle\Entity\Banners;
use NW\PrincipalBundle\Entity\Anuncios;
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

    public function misproductosAction(Request $request)
    {
    	// Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();
		
		// Obtener Datos del proveedor
        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();
        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        // Formulario de nuevo artículo
        $formArticuloData['datos'] = new Articulos();
        $formArticuloData['foto'] = new FotosArticulos();
        $formArticulo = $this->createForm(new ArticuloType(), $formArticuloData); // Formulario de usuarios mezclado con el de novias y novios

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1 (Artículo nuevo)
            if ($request->request->has($formArticulo->getName())) {
                // handle the first form
                $formArticulo->handleRequest($request);
         
                if ($formArticulo->isValid()) {
        			
                    // Recuperando información de formularios
        			$newArticulo = $formArticulo["datos"]->getData();
        			$newArticuloFoto = $formArticulo["foto"]->getData();

                    // Si se eligió categoriá para el artículo, ésta se ubica, si no, entonces se mete en la categoría "Otros(id=27)"
                    if($formArticulo["categoria"]["categorias"]->getData())
                    {
                        $newArticuloCategoria = $this->getDoctrine()->getRepository('NWPrincipalBundle:Categorias')->find($formArticulo["categoria"]["categorias"]->getData());
                    }
                    else
                    {
                        $newArticuloCategoria = $this->getDoctrine()->getRepository('NWPrincipalBundle:Categorias')->find(27);
                    }
                    
                	$newArticulo->setUser($user);// Setteando el usuario en el artículo
                    $newArticulo->setCategoria($newArticuloCategoria);// Setteando la categoría en el artículo
                	$newArticuloFoto->setArticulo($newArticulo);// Setteando el articulo en la foto
                	$newArticulo->setTamanos(explode(',', $formArticulo["datos"]["tamanos"]->getData()));// Convierte en array los tamaños
                	$newArticuloFoto->upload($user->getId());// Subiendo la imagen

                    $em->persist($newArticulo);
                    $em->persist($newArticuloFoto);
                    $em->flush();
                }
            }
            // Formulario2
            /*else if ($request->request->has($formOtro->getName())) {
                // handle the second form
                $formOtro->handleRequest($request);
         
                if ($formOtro->isValid()) {
        
                    //Contenido
                }
            }*/
        }

        // Obteniendo la lista de artículos en un arreglo de objetos
        $articulos = $em->getRepository('NWPrincipalBundle:Articulos')->findBy(array('usuarioId' => $user->getId()));

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

        return $this->render('NWPrincipalBundle:Proveedores:misproductos.html.twig', array(
            'proveedor' => $proveedor,
            'formArticulo' => $formArticulo->createView(),
            'articulos' => $articulos,
        ));
    }

    public function misbannersAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();

        // Formulario del anuncio
        $formBannerData = new Banners();
        $formBanner = $this->createForm(new BannersType(), $formBannerData);

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1 (Agregar Banner)
            if ($request->request->has($formBanner->getName())) {
                // handle the first form
                $formBanner->handleRequest($request);
         
                if ($formBanner->isValid()) {
      
				    $formBannerData->setUser($user);
      				$formBannerData->upload($user->getId());

                    $em->persist($formBannerData);

                    $em->flush();
                }
            }
            // Formulario2
            /*else if ($request->request->has($formOtro->getName())) {
                // handle the second form
                $formOtro->handleRequest($request);
         
                if ($formOtro->isValid()) {
        
                    //Contenido
                }
            }*/
        }

        // Obteniendo la lista de banners en un arreglo de objetos
        $banners = $em->getRepository('NWPrincipalBundle:Banners')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados en arrays
        foreach($banners as $index=>$value)
        {
            $objetoenArray=$banners[$index]->getValues();
            $banners[$index]=$objetoenArray;
        }

        return $this->render('NWPrincipalBundle:Proveedores:misbanners.html.twig', array(
            'proveedor' => $proveedor,
            'formBanner' => $formBanner->createView(),
            'banners' => $banners,
        ));
    }

    public function misanunciosAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $proveedorObject=$user->getRegistroproveedores();

        $proveedor['nombre']=$proveedorObject->getNombreRazon();
        $proveedor['cuenta']=$proveedorObject->getId();
        
        // Se carga un anuncio del proveedor si es que ya existe
      	$AnuncioViejo = $em->getRepository('NWPrincipalBundle:Anuncios')->findOneByUsuarioId($user->getId());

      	if ($AnuncioViejo)
      	{
      		$anuncioWebpage = $AnuncioViejo->getWebpage();
      		$anuncioImagePath = $AnuncioViejo->getWebPath();
      	}
      	else
      	{
      		$anuncioWebpage = "No se ha definido ningun sitio";
      		$anuncioImagePath = "img/anuncio.jpg";
      	}

        // Formulario del anuncio
        $formAnuncioData = new Anuncios();
        $formAnuncio = $this->createForm(new AnuncioType(), $formAnuncioData);

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1 (Editar Anuncio)
            if ($request->request->has($formAnuncio->getName())) {
                // handle the first form
                $formAnuncio->handleRequest($request);
         
                if ($formAnuncio->isValid()) {
      
                	// Si ya existe un anuncio se actualiza, si no se hace una nuevo
      				if ($AnuncioViejo) {
      					$AnuncioViejo->setFile($formAnuncioData->getFile());
      					$AnuncioViejo->setWebpage($formAnuncioData->getWebpage());
      					$AnuncioViejo->upload();

      					$em->persist($AnuncioViejo);
				    }
				    else{
					    $formAnuncioData->setUser($user);
	      				$formAnuncioData->upload();

	                    $em->persist($formAnuncioData);
                	}

                    $em->flush();
                }
            }
            // Formulario2
            /*else if ($request->request->has($formOtro->getName())) {
                // handle the second form
                $formOtro->handleRequest($request);
         
                if ($formOtro->isValid()) {
        
                    //Contenido
                }
            }*/
        }

        return $this->render('NWPrincipalBundle:Proveedores:misanuncios.html.twig', array(
        	'formAnuncio' => $formAnuncio->createView(),
            'proveedor' => $proveedor,
            'anuncioWebpage' => $anuncioWebpage,
            'anuncioImagePath' => $anuncioImagePath,
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