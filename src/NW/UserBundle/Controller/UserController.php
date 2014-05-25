<?php

namespace NW\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NW\UserBundle\Entity\usuario;
use NW\UserBundle\Entity\Novias;
use NW\UserBundle\Entity\Novios;
use NW\UserBundle\Entity\registroproveedores;
use NW\UserBundle\Entity\Reportero;
use NW\PrincipalBundle\Entity\Bodas;

use NW\UserBundle\Form\Type\RegistroType;
use NW\UserBundle\Form\Type\ReporteroType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class UserController extends Controller
{
    public function loginnoviosAction()
    {
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

        return $this->render(
            'NWUserBundle:User:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function registronoviosAction(Request $request)
    {
           
        /* Formulario individual para Novias (ejemplo)
        $noviasClass = 'Acme\TaskBundle\Entity\Novias';
        $form = $this->createForm(new NoviazgoType(), $noviasClass);
        */

        // Generando el formulario de registro de los novios y usuario
        $formData['novias'] = new Novias();
        $formData['novios'] = new Novios();
        $form = $this->createForm(new RegistroType(), $formData); // Formulario de usuarios mezclado con el de novias y novios

        // Solicitando datos del formulario para ver si recuperar los datos, mostrar error o mostrar formulario
        $form->handleRequest($request);
 
        if ($form->isValid()) {

            // Recuperando datos de los novios
            $novias = $form["novias"]->getData();
            $novios = $form["novios"]->getData();

            // Agregando Usuario y sus datos
            $userManager = $this->get('fos_user.user_manager'); 
            $user = $userManager->createUser();

            $user->setUsername($form["userName"]->getData());
            $user->setEmail($form["novios"]["eMail"]->getData());
            $user->setPlainPassword($form["userPass"]->getData());
            $user->addRole('ROLE_NOVIO');
            $user->setEnabled(true);

            // Agregando Estado de la novia
            $estadoNovia=$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($form["novias"]["estado"]->getData());
            $estadoNovia->addNovia($novias);
            $novias->setEstados($estadoNovia);

            // Agregando Estado del novio
            $estadoNovio=$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($form["novios"]["estado"]->getData());
            $estadoNovio->addNovio($novios);
            $novios->setEstados($estadoNovio);

            // Agregando Usuario a los novios
            $novias->setUser($user);
            $novios->setUser($user);

            // Agregando Novia al Novio
            $novios->setNovia($novias);

            // Agregando objeto boda a los novios
            $boda = new Bodas();
            $boda->setUser($user);
            $boda->setCeremonia('');
            $boda->setCeremoniaDireccion('');
            $boda->setRecepcion('');
            $boda->setRecepcionDireccion('');
            $boda->setFechaBoda(\DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00'));

            // Persistiendo los datos en la base de datos
            $em = $this->getDoctrine()->getEntityManager(); 
            $em->persist($user);
            $em->persist($novias);
            $em->persist($novios);
            $em->persist($boda);
            $em->flush();

            // El registro del formulario fue exitoso y se muestra mensaje de felicitación
            return $this->redirect($this->generateUrl('nw_user_registro_exitoso'));

        }
        else{
            // Si no se ha ocupado el formulario (o contiene errores) se le muestra al usuario
            return $this->render('NWUserBundle:User:registronovios.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function registroproveedoresAction(Request $request)
    {
        // crea un nuevo registro y le asigna algunos datos
        $registro = new registroproveedores();
        $registro->setTipoPersona('');
        $registro->setNombreRazon('');
        $registro->setApellidoPaterno('');
        $registro->setApellidoMaterno('');
        $registro->setRfc('');
        $registro->setEmail('');
        $registro->setLada('');
        $registro->setTelefono('');
        $registro->setCelular('');
        $registro->setDireccion('');
        $registro->setEstado('');
        $registro->setCiudad('');
        $registro->setCp('');
        $registro->setPlan('');
 
        $form = $this->createFormBuilder($registro)
            ->add('tipoPersona', 'choice', array('choices' => 
                array('fisica' => 'Persona Física', 'moral' => 'Persona Moral'),
                'multiple' => false, 'expanded' => true, 'required' => true, 'empty_data'  => null))
            ->add('nombreRazon', 'text')
            ->add('apellidoPaterno', 'text', array('required' => false))
            ->add('apellidoMaterno', 'text', array('required' => false))
            ->add('rfc', 'text')
            ->add('email', 'email')
            ->add('lada', 'text', array('max_length' => 3))
            ->add('telefono', 'text', array('max_length' => 8))
            ->add('celular', 'text', array('max_length' => 10))
            ->add('direccion', 'text')
            ->add('pais', 'choice', array('choices' => array(
                    'MX'   => 'México',
                    ), 'mapped' => false, 'multiple'  => false,))
            ->add('estado', 'choice', array('choices' => array(
                     '1'   => 'Aguascalientes',
                     '2'   => 'Baja California',
                     '3'   => 'Baja California Sur',
                     '4'   => 'Campeche',
                     '5'   => 'Chiapas',
                     '6'   => 'Chihuahua',
                     '7'   => 'Coahuila',
                     '8'   => 'Colima',
                     '9'   => 'Distrito Federal',
                     '10'   => 'Durango',
                     '11'   => 'Estado de México',
                     '12'   => 'Guanajuato',
                     '13'   => 'Guerrero',
                     '14'   => 'Hidalgo',
                     '15'   => 'Jalisco',
                     '16'   => 'Michoacán',
                     '17'   => 'Morelos',
                     '18'   => 'Nayarit',
                     '19'   => 'Nuevo León',
                     '20'   => 'Oaxaca',
                     '21'   => 'Puebla',
                     '22'   => 'Querétaro',
                     '23'   => 'Quintana Roo',
                     '24'   => 'San Luis Potosí',
                     '25'   => 'Sinaloa',
                     '26'   => 'Sonora',
                     '27'   => 'Tabasco',
                     '28'   => 'Tamaulipas',
                     '29'   => 'Tlaxcala',
                     '30'   => 'Veracruz',
                     '31'   => 'Yucatán',
                     '32'   => 'Zacatecas',
                    ), 'multiple'  => false,))
            ->add('ciudad', 'text')
            ->add('cp', 'text', array('max_length' => 5))
            ->add('userName', 'text', array('mapped' => false, 'required'  => true))
            ->add('userPass', 'password', array('mapped' => false, 'required'  => true))
            ->add('terminosCondiciones', 'checkbox', array('mapped' => false, 'required'  => true))
            ->add('terminosPrivacidad', 'checkbox', array('mapped' => false, 'required'  => true))
            ->add('plan', 'choice', array('choices' => 
                array(
                    'anuncioEspecial' => 'Anuncio Especial',
                    'anuncioPlus' => 'Anuncio Plus',
                    'basico' => 'Básico',
                    'estandar' => 'Estándar',
                    'plus' => 'Plus'
                ),
                'multiple' => false, 'expanded' => true, 'required' => true, 'empty_data'  => null))
            ->add('Aceptar', 'submit')
            ->getForm();

        $form->handleRequest($request);
 
        if ($form->isValid()) {

            // Recuperando datos del formulario
            $proveedor = $form->getData();

            // Agregando Usuario
            $userManager = $this->get('fos_user.user_manager'); 
            $user = $userManager->createUser(); 

            $user->setUsername($form["userName"]->getData());
            $user->setEmail($form["email"]->getData());
            $user->setPlainPassword($form["userPass"]->getData());
            $user->setEnabled(true);

            // Agregando rol de plan de proveedor
            switch ($form["plan"]->getData()) {
                case 'anuncioEspecial':
                    $user->addRole('ROLE_PROVEEDOR_ANUNCIO');
                    break;
                case 'anuncioPlus':
                    $user->addRole('ROLE_PROVEEDOR_ANUNCIO');
                    break;
                case 'basico':
                    $user->addRole('ROLE_PROVEEDOR_BASICO');
                    break;
                case 'estandar':
                    $user->addRole('ROLE_PROVEEDOR_ESTANDAR');
                    break;
                case 'plus':
                    $user->addRole('ROLE_PROVEEDOR_PLUS');
                    break;
                default:
                    $user->addRole('ROLE_PROVEEDOR');
                    break;
            }

            // Agregando Apellidos invisibles al proveedor si se trata de persona moral o si no existen apellidos
            if($form["tipoPersona"]->getData() == "moral")
            {
                $proveedor->setApellidoPaterno(" ");
                $proveedor->setApellidoMaterno(" ");
            }
            if(!$form["apellidoPaterno"]->getData())
            {
                $proveedor->setApellidoPaterno(" ");
            }
            if(!$form["apellidoMaterno"]->getData())
            {
                $proveedor->setApellidoMaterno(" ");
            }


            // Agregando Estado del proveedor
            $estado=$this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($form["estado"]->getData());
            $estado->addRegistroproveedore($proveedor);
            $proveedor->setEstados($estado);

            // Agregando Usuario a la tabla de registroproveedor
            $proveedor->setUser($user);
            
            $em = $this->getDoctrine()->getEntityManager(); 
            $em->persist($user);
            $em->persist($proveedor);
            $em->flush();
     
            /*return new Response(
                'proveedor creados con ID: '.$proveedor->getId().' y usuario con ID: '.$user->getId()
            );*/

            return $this->redirect($this->generateUrl('nw_user_registro_exitoso'));

        }
        else{
            return $this->render('NWUserBundle:User:registroproveedores.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function registroReporteroAction(Request $request)
    {
        // Servicio con funciones para reportero
        $reporteroService = $this->get('reportero_service');

        // Nuevo objeto reportero y su formulario
        $reportero = new Reportero();
        $formReportero = $this->createForm(new ReporteroType(), $reportero);

        // Recuperando formulario de reportero
        $formReportero->handleRequest($request);
        if ($formReportero->isValid()) {

            // Registrar reportero mediante el servicio de reportero
            $reporteroService->registrarReportero($reportero, $formReportero['userName']->getData(), $formReportero['userPass']->getData());
            
            // Redirigir a la página de registro exitoso
            $redirect = $this->generateUrl('nw_user_registro_exitoso');
            return $this->redirect($redirect);
        }

        // Generar página para el registro de nuevos reporteros
        return $this->render('NWUserBundle:User:registroreportero.html.twig', array(
            'formReportero' => $formReportero->createView(),
        ));
    }

    public function registroExitosoAction()
    {
        return $this->render('NWUserBundle:User:felicidades.html.twig');
    }
/*
    public function asignarRolesAction()
    {

        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => 'docsernovios'));
        //$user->addRole('ROLE_ONE');
        $user->setRoles(array('ROLE_USER1','ROLE_NOVIOS'));
        $userManager->updateUser($user);

        return new Response('Nuevo rol asignado correctamente al usuario '.$user->getId());
    }


	public function loginAction()
    {
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

        return $this->render(
            'NWUserBundle::login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );

    }

    public function newuserAction()
	{
		$factory = $this->get('security.encoder_factory');
		$usuario = new usuario();
		 
		$encoder = $factory->getEncoder($usuario);
		$password = $encoder->encodePassword('987410', ''); //, $usuario->getSalt()

	    $usuario->setUsername('Valerio2');
	    $usuario->setEmail('docser2@gmail.com');
	    $usuario->setPassword($password);
	 
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($usuario);
	    $em->flush();
	 
	    return new Response('Usuario creado con id '.$usuario->getId());
	}

    public function asignRolesAction()
    {
        $roles= array('ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER');

        foreach($roles as $key => $value)
        {
            $user->addRole($value);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();

        return new Response('Usuario creado con id '.$user->getId());
    }*/
}
