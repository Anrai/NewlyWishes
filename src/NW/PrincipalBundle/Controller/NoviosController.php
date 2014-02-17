<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NW\PrincipalBundle\Form\Type\EdicionNoviosType;
use NW\PrincipalBundle\Form\Type\ChecklistType;

use NW\PrincipalBundle\Entity\Checklist;

use NW\UserBundle\Entity\Novias;
use NW\UserBundle\Entity\Novios;

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
	
	public function nuestroChecklistAction(Request $request)
    {
        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        $formAgregarData = new Checklist();
        $formAgregar = $this->createForm(new ChecklistType(), $formAgregarData);

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
 
            // ¿El formulario que se envió es el de cambio de contraseña?
            if ($request->request->has($formAgregar->getName())) {
                // Recuperando datos del formulario de cambio de contraseña
                $formAgregar->handleRequest($request);

                if($formAgregar->isValid())
                {
                    $newTask=$formAgregar->getData();
                    $newTask->setUser($user);
                    $newTask->setStatus(false);

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($newTask);
                    $em->flush();
                }
            }
            // Se administra el otro formulario
            /*else if ($request->request->has($formNovios->getName())) {
                // handle the second form
                $formNovios->handleRequest($request);
         
                if ($formNovios->isValid()) {

                    //Contenido
                }
            }*/
        }

        // Obteniendo la lista de tareas en un arreglo de objectos
        $em = $this->getDoctrine()->getEntityManager();
        $tasks = $em->getRepository('NWPrincipalBundle:Checklist')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados en arrays
        foreach($tasks as $index=>$value)
        {
            $objetoenArray=$tasks[$index]->getValues();
            $tasks[$index]=$objetoenArray;
        }

        return $this->render('NWPrincipalBundle:Novios:nuestro-checklist.html.twig', array(
            'formAgregar' => $formAgregar->createView(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'tasks'=>$tasks,
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

        // Formulario de edición de datos de los novios
        $NoviasObject=new Novias();
            $NoviasObject->setNombre('');// Con esto se muestra el nombre que se quiera en el formulario renderizado
        $formData['novias'] = $NoviasObject;
        $formData['novios'] = new Novios();
        $formNovios = $this->createForm(new EdicionNoviosType(), $formData); // Formulario de usuarios mezclado con el de novias y novios

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
            // ¿El formulario que se envió es el de edición de los datos de los novios?
            else if ($request->request->has($formNovios->getName())) {
                // handle the second form
                $formNovios->handleRequest($request);
         
                if ($formNovios->isValid()) {

                    // Recuperando datos de los novios
                    $noviasNew = $formNovios["novias"]->getData();
                    $noviosNew = $formNovios["novios"]->getData();

                    // Agregando datos de la novia
                    $estadoNoviaNew=$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($formNovios["novias"]["estado"]->getData());
                    
                    $novia->setNombre($formNovios["novias"]["nombre"]->getData());
                    $novia->setsNombre($formNovios["novias"]["sNombre"]->getData());
                    $novia->setAPaterno($formNovios["novias"]["aPaterno"]->getData());
                    $novia->setAMaterno($formNovios["novias"]["aMaterno"]->getData());
                    $novia->setEMail($formNovios["novias"]["eMail"]->getData());
                    $novia->setLada($formNovios["novias"]["lada"]->getData());
                    $novia->setTelefono($formNovios["novias"]["telefono"]->getData());
                    $novia->setCelular($formNovios["novias"]["celular"]->getData());
                    $novia->setDireccion($formNovios["novias"]["direccion"]->getData());
                    $novia->setEstados($estadoNoviaNew);
                    $novia->setCiudad($formNovios["novias"]["ciudad"]->getData());
                    $novia->setCp($formNovios["novias"]["cp"]->getData());

                    // Agregando datos del novio
                    $estadoNovioNew =$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($formNovios["novios"]["estado"]->getData());

                    $novio->setNombre($formNovios["novios"]["nombre"]->getData());
                    $novio->setsNombre($formNovios["novios"]["sNombre"]->getData());
                    $novio->setAPaterno($formNovios["novios"]["aPaterno"]->getData());
                    $novio->setAMaterno($formNovios["novios"]["aMaterno"]->getData());
                    $novio->setEMail($formNovios["novios"]["eMail"]->getData());
                    $novio->setLada($formNovios["novios"]["lada"]->getData());
                    $novio->setTelefono($formNovios["novios"]["telefono"]->getData());
                    $novio->setCelular($formNovios["novios"]["celular"]->getData());
                    $novio->setDireccion($formNovios["novios"]["direccion"]->getData());
                    $novio->setEstados($estadoNovioNew);
                    $novio->setCiudad($formNovios["novios"]["ciudad"]->getData());
                    $novio->setCp($formNovios["novios"]["cp"]->getData());

                    // Persistiendo los datos en la base de datos
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($novia);
                    $em->persist($novio);
                    $em->flush();
                }
            }
        }

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

        // Renderear la plantilla con la información necesaria
        return $this->render('NWPrincipalBundle:Novios:nuestra-cuenta.html.twig', array(
            'form' => $form->createView(),
            'formNovios' => $formNovios->createView(),
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