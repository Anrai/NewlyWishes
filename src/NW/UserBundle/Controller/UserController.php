<?php

namespace NW\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NW\UserBundle\Entity\usuario;
use NW\UserBundle\Entity\Novias;
use NW\UserBundle\Entity\Novios;
use NW\UserBundle\Entity\registroproveedores;

use NW\UserBundle\Form\Type\RegistroType;

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

        $formData['novias'] = new Novias();
        $formData['novios'] = new Novios();
        $form = $this->createForm(new RegistroType(), $formData); // Formulario de usuarios mezclado con el de novias y novios

        $form->handleRequest($request);
 
        if ($form->isValid()) {

            // Recuperando datos de los novios
            $novias = $form["novias"]->getData();
            $novios = $form["novios"]->getData();

            // Agregando Usuario
            $userManager = $this->get('fos_user.user_manager'); 
            $user = $userManager->createUser();

            $user->setUsername($form["userName"]->getData());
            $user->setEmail($form["novios"]["eMail"]->getData());
            $user->setPlainPassword($form["userPass"]->getData());
            $user->setEnabled(true);

            // Obteniendo el Estado de procedencia de los novios
            $noviaEstado = $this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($form["novias"]["estado2"]->getData());
            $novioEstado = $this->getDoctrine()->getRepository('NWPrincipalBundle:Estados')->find($form["novios"]["estado2"]->getData());
            $novias->setEstado($noviaEstado);
            $novios->setEstado($novioEstado);

            // Agregando Usuario a la tabla de registronovios
            $novias->setUser($user);
            $novios->setUser($user);
            
            $em = $this->getDoctrine()->getEntityManager(); 
            $em->persist($user);
            $em->persist($novias);
            $em->persist($novios);
            $em->flush();
     
            /*return new Response(
                'Novios creados con ID: '.$novios->getId().' y usuario con ID: '.$user->getId()
            );*/

            return new Response(
                'Nombre de usuario: '.$form["userName"]->getData()
            );

        }
        else{
            return $this->render('NWUserBundle:User:registronovios.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function registroproveedoresAction(Request $request)
    {
        // crea un nuevo registro y le asigna algunos datos
        $registro = new registroproveedores();
        $registro->settipoPersona('');
        $registro->setnombreRazon('');
        $registro->setapellidoPaterno('');
        $registro->setapellidoMaterno('');
        $registro->setrfc('');
        $registro->setemail('');
        $registro->setlada('');
        $registro->settelefono('');
        $registro->setcelular('');
        $registro->setdireccion('');
        $registro->setpais('');
        $registro->setestado('');
        $registro->setciudad('');
        $registro->setcp('');
 
        $form = $this->createFormBuilder($registro)
            ->add('tipoPersona', 'choice', array('choices' => 
                array('fisica' => 'Persona Física', 'moral' => 'Persona Moral'),
                'multiple' => false, 'expanded' => true, 'required' => true, 'empty_data'  => null))
            ->add('nombreRazon', 'text')
            ->add('apellidoPaterno', 'text')
            ->add('apellidoMaterno', 'text')
            ->add('rfc', 'text')
            ->add('email', 'email')
            ->add('lada', 'text', array('max_length' => 3))
            ->add('telefono', 'text', array('max_length' => 8))
            ->add('celular', 'text', array('max_length' => 10))
            ->add('direccion', 'text')
            ->add('pais', 'choice', array('choices' => array(
                    'MX'   => 'México',
                    ), 'multiple'  => false,))
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
            ->add('Enviar', 'submit')
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

            // Agregando Usuario a la tabla de registroproveedor
            
            $proveedor->setUser($user);
            
            $em = $this->getDoctrine()->getEntityManager(); 
            $em->persist($user);
            $em->persist($proveedor);
            $em->flush();
     
            /*return new Response(
                'proveedor creados con ID: '.$proveedor->getId().' y usuario con ID: '.$user->getId()
            );*/

            return new Response('Travesura realizada');

        }
        else{
            return $this->render('NWUserBundle:User:registroproveedores.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }

    public function asignarRolesAction()
    {

        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => 'Docser'));
        //$user->addRole('ROLE_ONE');
        $user->setRoles(array('ROLE_USER1','ROLE_USER2','ROLE_USER3'));
        $userManager->updateUser($user);

        return new Response('Nuevo rol asignado correctamente al usuario '.$user->getId());
    }

/*
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
