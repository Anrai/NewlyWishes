<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NW\PrincipalBundle\Form\Type\EdicionNoviosType;
use NW\PrincipalBundle\Form\Type\ChecklistType;
use NW\PrincipalBundle\Form\Type\ListaInvitadosType;
use NW\PrincipalBundle\Form\Type\DatosBodaType;
use NW\PrincipalBundle\Form\Type\PadrinosType;
use NW\PrincipalBundle\Form\Type\NotasType;
use NW\PrincipalBundle\Form\Type\RegaloType;
use NW\PrincipalBundle\Form\Type\DiaBodaType;

use NW\PrincipalBundle\Entity\Checklist;
use NW\PrincipalBundle\Entity\ListaInvitados;
use NW\PrincipalBundle\Entity\Bodas;
use NW\PrincipalBundle\Entity\Padrinos;
use NW\PrincipalBundle\Entity\Notas;
use NW\PrincipalBundle\Entity\MesaRegalos;
use NW\PrincipalBundle\Entity\CatRegalos;

use NW\UserBundle\Entity\Novias;
use NW\UserBundle\Entity\Novios;

class NoviosController extends Controller
{
    public function indexAction()
    {
        return $this->render('NWPrincipalBundle:Novios:index.html.twig');
    }
	
	public function nuestraBodaAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();

        // Recuperar datos de la boda que ya existen (si es que existen)
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        $formBodaData = new Bodas();
        if($BodaVieja)
        {
            $formBodaData->setCeremonia($BodaVieja->getCeremonia());
            $formBodaData->setCeremoniaDireccion($BodaVieja->getCeremoniaDireccion());
            $formBodaData->setRecepcion($BodaVieja->getRecepcion());
            $formBodaData->setRecepcionDireccion($BodaVieja->getRecepcionDireccion());
        }
         
        // Generar Formularios   
        $formBoda = $this->createForm(new DatosBodaType(), $formBodaData);
        $formPadrinosData = new Padrinos();
        $formPadrinos = $this->createForm(new PadrinosType(), $formPadrinosData);
        $formNotasData = new Notas();
        $formNotas = $this->createForm(new NotasType(), $formNotasData);
        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
 
            // Formulario para agregar datos de la boda
            if ($request->request->has($formBoda->getName())) {
                // Recuperando datos del formulario
                $formBoda->handleRequest($request);

                if($formBoda->isValid())
                {
                    // Borrar registros de la boda antiguos (si es que existen)
                    if($BodaVieja)
                        {$em->remove($BodaVieja);}

                    $newBoda=$formBoda->getData();
                    $newBoda->setUser($user);
                    // Recordar la fecha de la boda o setear en el 2000 si no hay fecha
                    if($BodaVieja->hayFechaBoda())
                    {
                        $newBoda->setFechaBoda($BodaVieja->getFechaBoda());
                    }
                    else
                    {
                        $newBoda->setFechaBoda(\DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00'));
                    }

                    $em->persist($newBoda);
                    $em->flush();
                }
            }
            // Formulario de agregar padrino
            else if ($request->request->has($formPadrinos->getName())) {
                // Recuperando datos del formulario
                $formPadrinos->handleRequest($request);

                if($formPadrinos->isValid())
                {
                    $newPadrino=$formPadrinos->getData();
                    $newPadrino->setUser($user);

                    $em->persist($newPadrino);
                    $em->flush();
                }
            }
            // Formulario de agregar nota
            else if ($request->request->has($formNotas->getName())) {
                // Recuperando datos del formulario
                $formNotas->handleRequest($request);

                if($formNotas->isValid())
                {
                    $newNota=$formNotas->getData();
                    $newNota->setUser($user);

                    $em->persist($newNota);
                    $em->flush();
                }
            }
            // Formulario para cambiar la fecha de la boda
            else if ($request->request->has($formDiaBoda->getName())) {
                // Recuperando datos del formulario
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
        }

        // Obteniendo la lista de padrinos y notas en sus respectivos arreglos de objetos
        $padrinos = $em->getRepository('NWPrincipalBundle:Padrinos')->findBy(array('usuarioId' => $user->getId()));
        $notas = $em->getRepository('NWPrincipalBundle:Notas')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados de padrinos en arrays
        foreach($padrinos as $index=>$value)
        {
            $objetoenArray=$padrinos[$index]->getValues();
            $padrinos[$index]=$objetoenArray;
        }

        // Convirtiendo los resultados de notas en arrays
        foreach($notas as $index=>$value)
        {
            $objetoenArray=$notas[$index]->getValues();
            $notas[$index]=$objetoenArray;
        }

        return $this->render('NWPrincipalBundle:Novios:nuestra-boda.html.twig', array(
            'formBoda' => $formBoda->createView(),
            'formPadrinos' => $formPadrinos->createView(),
            'formNotas' => $formNotas->createView(),
            'formDiaBoda' => $formDiaBoda->createView(),
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'padrinos' => $padrinos,
            'notas' => $notas,
        ));
    }

    public function PadrinoDeleteAction($id) // Controlador que borra un padrino según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $padrino = $em->getRepository('NWPrincipalBundle:Padrinos')->find($id);
        $em->remove($padrino);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-boda'));
    }

    public function NotaDeleteAction($id) // Controlador que borra una nota según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $nota = $em->getRepository('NWPrincipalBundle:Notas')->find($id);
        $em->remove($nota);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-boda'));
    }
	
	public function nuestroCalendarioAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        // Formularios
        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1
            if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
        }

        return $this->render('NWPrincipalBundle:Novios:nuestro-calendario.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
            'formDiaBoda' => $formDiaBoda->createView(),
        ));
    }
	
	public function nuestroChecklistAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        $formAgregarData = new Checklist();
        $formAgregar = $this->createForm(new ChecklistType(), $formAgregarData);
        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
 
            // Formulario de agregar tarea
            if ($request->request->has($formAgregar->getName())) {
                // Recuperando datos del formulario de cambio de contraseña
                $formAgregar->handleRequest($request);

                if($formAgregar->isValid())
                {
                    $newTask=$formAgregar->getData();
                    $newTask->setUser($user);
                    $newTask->setStatus(false);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newTask);
                    $em->flush();
                }
            }
            else if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
        }

        // Obteniendo la lista de tareas en un arreglo de objectos
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository('NWPrincipalBundle:Checklist')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados en arrays
        foreach($tasks as $index=>$value)
        {
            $objetoenArray=$tasks[$index]->getValues();
            $tasks[$index]=$objetoenArray;
        }

        return $this->render('NWPrincipalBundle:Novios:nuestro-checklist.html.twig', array(
            'formAgregar' => $formAgregar->createView(),
            'formDiaBoda' => $formDiaBoda->createView(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'tasks'=>$tasks,
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
        ));
    }

    public function TaskDeleteAction($id) // Controlador que borra una tarea según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('NWPrincipalBundle:Checklist')->find($id);
        $em->remove($task);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestro-checklist'));
    }

    public function TaskCompletarAction($id) // Controlador que completa una tarea según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('NWPrincipalBundle:Checklist')->find($id);
        $task->setStatus(true);
        $em->persist($task);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestro-checklist'));
    }

    public function TaskDescompletarAction($id) // Controlador que descompleta una tarea según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('NWPrincipalBundle:Checklist')->find($id);
        $task->setStatus(false);
        $em->persist($task);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestro-checklist'));
    }
	
	public function nuestraMesaDeRegalosAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        // Nuevo objeto regalo para el formulario
        $formRegaloData = new MesaRegalos();
        $formRegalo = $this->createForm(new RegaloType(), $formRegaloData);
        $formDiaBoda = $this->createForm(new DiaBodaType());
        
        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1
            if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
            else if ($request->request->has($formRegalo->getName()))
            {
                $formRegalo->handleRequest($request);

                if($formRegalo->isValid())
                {
                    // Obtener datos del formulario
                    $newRegalo = $formRegalo->getData();

                    // Se recupera la categoria original
                    $categoria = $em->getRepository('NWPrincipalBundle:CatRegalos')->find($formRegalo['categoria']->getData());

                    // Asignar valores inexistentes en la nueva clase regalo: usuario, partes pagadas y categoría
                    $newRegalo->setUser($user);
                    $newRegalo->setHorcruxesPagados(0);
                    $newRegalo->setCatregalos($categoria);

                    $em->persist($newRegalo);
                    $em->flush();
                }
            }
        }

        // Obteniendo la lista de articulos de la mesa de regalos
        $regalos = $em->getRepository('NWPrincipalBundle:MesaRegalos')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados en arrays
        foreach($regalos as $index=>$value)
        {
            $objetoenArray=$regalos[$index]->getValues();
            $regalos[$index]=$objetoenArray;
            $regalos[$index]['categoria']=$em->getRepository('NWPrincipalBundle:CatRegalos')->find($regalos[$index]['categoria'])->getCategoriaName();
        }

        return $this->render('NWPrincipalBundle:Novios:nuestra-mesa-de-regalos.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'regalos' => $regalos,
            'formRegalo' => $formRegalo->createView(),
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
            'formDiaBoda' => $formDiaBoda->createView(),
        ));
    }

     public function RegaloDeleteAction($id) // Controlador que borra un regalo según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $regalo = $em->getRepository('NWPrincipalBundle:MesaRegalos')->find($id);
        $em->remove($regalo);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-mesa-de-regalos'));
    }
	
	public function nuestraListaDeInvitadosAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        $formAgregarData = new ListaInvitados();
        $formAgregar = $this->createForm(new ListaInvitadosType(), $formAgregarData);
        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1
            if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
            else if($request->request->has($formAgregar->getName())) {
                // Manejo de los datos del formulario
                $formAgregar->handleRequest($request);

                if($formAgregar->isValid())
                {
                    $newInvitado=$formAgregar->getData();
                    $newInvitado->setUser($user);
                    $newInvitado->setStatus(false);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newInvitado);
                    $em->flush();
                }
            }
        }

        // Obteniendo la lista de invitados en un arreglo de objetos
        $em = $this->getDoctrine()->getManager();
        $invitados = $em->getRepository('NWPrincipalBundle:ListaInvitados')->findBy(array('usuarioId' => $user->getId()));

        // Convirtiendo los resultados en arrays
        $confirmadosInvitados=0;
        foreach($invitados as $index=>$value)
        {
            $objetoenArray=$invitados[$index]->getValues();
            $invitados[$index]=$objetoenArray;

            if($invitados[$index]['status'])
            {
                $confirmadosInvitados++;
            }
        }

        return $this->render('NWPrincipalBundle:Novios:nuestra-lista-de-invitados.html.twig', array(
            'formAgregar' => $formAgregar->createView(),
            'formDiaBoda' => $formDiaBoda->createView(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'totalInvitados' => count($invitados),
            'confirmadosInvitados' => $confirmadosInvitados,
            'invitados'=>$invitados,
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
        ));
    }

    public function InvitadoDeleteAction($id) // Controlador que borra un invitado según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $invitado = $em->getRepository('NWPrincipalBundle:ListaInvitados')->find($id);
        $em->remove($invitado);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-lista-de-invitados'));
    }

    public function InvitadoConfirmarAction($id) // Controlador que confirma un invitado según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $invitado = $em->getRepository('NWPrincipalBundle:ListaInvitados')->find($id);
        $invitado->setStatus(true);
        $em->persist($invitado);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-lista-de-invitados'));
    }

    public function InvitadoDesconfirmarAction($id) // Controlador que confirma un invitado según el id pasado
    {
        $em = $this->getDoctrine()->getManager();
        $invitado = $em->getRepository('NWPrincipalBundle:ListaInvitados')->find($id);
        $invitado->setStatus(false);
        $em->persist($invitado);
        $em->flush();

        return $this->redirect($this->generateUrl('nw_principal_novios_nuestra-lista-de-invitados'));
    }
	
	public function nuestraCuentaAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        // Formulario de edición de datos de los novios
        $formData2['novias'] = $novia; // Se recuperan datos de la novia
        $formData2['novios'] = $novio; // Se recuperan datos del novio
        $formNovios = $this->createForm(new EdicionNoviosType(), $formData2); // Formulario de usuarios mezclado con el de novias y novios
        $formDiaBoda = $this->createForm(new DiaBodaType());

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
                        $this->getDoctrine()->getManager()->flush();
                        
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
                    $em->persist($novia);
                    $em->persist($novio);
                    $em->flush();
                }
            }
            else if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
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
            'formDiaBoda' => $formDiaBoda->createView(),
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'noviaInfo' => $noviaInfo,
            'novioInfo' => $novioInfo,
            'statusForm' => $statusForm,
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
        ));
    }
	
	public function nuestraInformacionBancariaAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1
            if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
        }

        return $this->render('NWPrincipalBundle:Novios:nuestra-informacion-bancaria.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
            'formDiaBoda' => $formDiaBoda->createView(),
        ));
    }
	
	public function nuestrasComprasAction(Request $request)
    {
        // Manejador de Doctrine
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        $novia=$user->getNovias();
        $novio=$user->getNovios();
        $BodaVieja = $em->getRepository('NWPrincipalBundle:Bodas')->findOneByUsuarioId($user->getId());

        $formDiaBoda = $this->createForm(new DiaBodaType());

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
        
            // Formulario 1
            if ($request->request->has($formDiaBoda->getName())) {
                // handle the first form
                $formDiaBoda->handleRequest($request);

                if($formDiaBoda->isValid())
                {
                    $DiaBoda=$formDiaBoda['fecha']->getData();
                    $BodaVieja->setFechaBoda($DiaBoda);

                    $em->persist($BodaVieja);
                    $em->flush();
                }
            }
        }

        return $this->render('NWPrincipalBundle:Novios:nuestras-compras.html.twig', array(
            'novia' => $novia->getNombre(),
            'novio' => $novio->getNombre(),
            'hayFechaBoda' => $BodaVieja->hayFechaBoda(),
            'contadorFechaBoda' => $BodaVieja->contadorFechaBoda(),
            'formDiaBoda' => $formDiaBoda->createView(),
        ));
    }

}