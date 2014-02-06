<?php

namespace NW\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NW\UserBundle\Entity\usuario;
use NW\UserBundle\Entity\registronovios;
use NW\UserBundle\Entity\registroproveedores;
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
        // crea un nuevo registro y le asigna algunos datos
        $registro = new registronovios();
        $registro->setnoviaNombre('');
        $registro->setnoviaSNombre('');
        $registro->setnoviaAPaterno('');
        $registro->setnoviaAMaterno('');
        $registro->setnoviaEMail('');
        $registro->setnoviaLada('');
        $registro->setnoviaTelefono('');
        $registro->setnoviaCelular('');
        $registro->setnoviaPais('');
        $registro->setnoviaEstado('');
        $registro->setnoviaCiudad('');
        $registro->setnoviaCP('');
        $registro->setnovioNombre('');
        $registro->setnovioSNombre('');
        $registro->setnovioAPaterno('');
        $registro->setnovioAMaterno('');
        $registro->setnovioEMail('');
        $registro->setnovioLada('');
        $registro->setnovioTelefono('');
        $registro->setnovioCelular('');
        $registro->setnovioPais('');
        $registro->setnovioEstado('');
        $registro->setnovioCiudad('');
        $registro->setnovioCP('');
 
        $form = $this->createFormBuilder($registro)
            ->add('noviaNombre', 'text')
            ->add('noviaSNombre', 'text')
            ->add('noviaAPaterno', 'text')
            ->add('noviaAMaterno', 'text')
            ->add('noviaEMail', 'email')
            ->add('noviaLada', 'text', array('max_length' => 3))
            ->add('noviaTelefono', 'text', array('max_length' => 8))
            ->add('noviaCelular', 'text', array('max_length' => 10))
            ->add('noviaDireccion', 'text')
            ->add('noviaPais', 'choice', array('choices' => array(
                    'MX'   => 'México',
                    ), 'multiple'  => false,))
            ->add('noviaEstado', 'choice', array('choices' => array(
                     '0'   => 'Aguascalientes',
                     '1'   => 'Baja California',
                     '2'   => 'Baja California Sur',
                     '3'   => 'Campeche',
                     '4'   => 'Chiapas',
                     '5'   => 'Chihuahua',
                     '6'   => 'Coahuila',
                     '7'   => 'Colima',
                     '8'   => 'Distrito Federal',
                     '9'   => 'Durango',
                     '10'   => 'Estado de México',
                     '11'   => 'Guanajuato',
                     '12'   => 'Guerrero',
                     '13'   => 'Hidalgo',
                     '14'   => 'Jalisco',
                     '15'   => 'Michoacán',
                     '16'   => 'Morelos',
                     '17'   => 'Nayarit',
                     '18'   => 'Nuevo León',
                     '19'   => 'Oaxaca',
                     '20'   => 'Puebla',
                     '21'   => 'Querétaro',
                     '22'   => 'Quintana Roo',
                     '23'   => 'San Luis Potosí',
                     '24'   => 'Sinaloa',
                     '25'   => 'Sonora',
                     '26'   => 'Tabasco',
                     '27'   => 'Tamaulipas',
                     '28'   => 'Tlaxcala',
                     '29'   => 'Veracruz',
                     '30'   => 'Yucatán',
                     '31'   => 'Zacatecas',
                    ), 'multiple'  => false,))
            ->add('noviaCiudad', 'text')
            ->add('noviaCP', 'text', array('max_length' => 5))
            ->add('novioNombre', 'text')
            ->add('novioSNombre', 'text')
            ->add('novioAPaterno', 'text')
            ->add('novioAMaterno', 'text')
            ->add('novioEMail', 'email')
            ->add('novioLada', 'text', array('max_length' => 3))
            ->add('novioTelefono', 'text', array('max_length' => 8))
            ->add('novioCelular', 'text', array('max_length' => 10))
            ->add('novioDireccion', 'text')
            ->add('novioPais', 'choice', array('choices' => array(
                    'MX'   => 'México',
                    ), 'multiple'  => false,))
            ->add('novioEstado', 'choice', array('choices' => array(
                     '0'   => 'Aguascalientes',
                     '1'   => 'Baja California',
                     '2'   => 'Baja California Sur',
                     '3'   => 'Campeche',
                     '4'   => 'Chiapas',
                     '5'   => 'Chihuahua',
                     '6'   => 'Coahuila',
                     '7'   => 'Colima',
                     '8'   => 'Distrito Federal',
                     '9'   => 'Durango',
                     '10'   => 'Estado de México',
                     '11'   => 'Guanajuato',
                     '12'   => 'Guerrero',
                     '13'   => 'Hidalgo',
                     '14'   => 'Jalisco',
                     '15'   => 'Michoacán',
                     '16'   => 'Morelos',
                     '17'   => 'Nayarit',
                     '18'   => 'Nuevo León',
                     '19'   => 'Oaxaca',
                     '20'   => 'Puebla',
                     '21'   => 'Querétaro',
                     '22'   => 'Quintana Roo',
                     '23'   => 'San Luis Potosí',
                     '24'   => 'Sinaloa',
                     '25'   => 'Sonora',
                     '26'   => 'Tabasco',
                     '27'   => 'Tamaulipas',
                     '28'   => 'Tlaxcala',
                     '29'   => 'Veracruz',
                     '30'   => 'Yucatán',
                     '31'   => 'Zacatecas',
                    ), 'multiple'  => false,))
            ->add('novioCiudad', 'text')
            ->add('novioCP', 'text', array('max_length' => 5))
            ->add('userName', 'text', array('mapped' => false, 'required'  => true))
            ->add('userPass', 'password', array('mapped' => false, 'required'  => true))
            ->add('terminosCondiciones', 'checkbox', array('mapped' => false, 'required'  => true))
            ->add('terminosPrivacidad', 'checkbox', array('mapped' => false, 'required'  => true))
            ->add('Enviar', 'submit')
            ->getForm();

        $form->handleRequest($request);
 
        if ($form->isValid()) {

            // Recuperando datos del formulario
            $novios = $form->getData();

            // Agregando Usuario
            $userManager = $this->get('fos_user.user_manager'); 
            $user = $userManager->createUser(); 

            $user->setUsername($form["userName"]->getData());
            $user->setEmail($form["novioEMail"]->getData());
            $user->setPlainPassword($form["userPass"]->getData());
            $user->setEnabled(true);

            // Agregando Usuario a la tabla de registronovios
            
            $novios->setUser($user);
            
            $em = $this->getDoctrine()->getEntityManager(); 
            $em->persist($user);
            $em->persist($novios);
            $em->flush();
     
            /*return new Response(
                'Novios creados con ID: '.$novios->getId().' y usuario con ID: '.$user->getId()
            );*/

            return new Response('Hola!');

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
                     '0'   => 'Aguascalientes',
                     '1'   => 'Baja California',
                     '2'   => 'Baja California Sur',
                     '3'   => 'Campeche',
                     '4'   => 'Chiapas',
                     '5'   => 'Chihuahua',
                     '6'   => 'Coahuila',
                     '7'   => 'Colima',
                     '8'   => 'Distrito Federal',
                     '9'   => 'Durango',
                     '10'   => 'Estado de México',
                     '11'   => 'Guanajuato',
                     '12'   => 'Guerrero',
                     '13'   => 'Hidalgo',
                     '14'   => 'Jalisco',
                     '15'   => 'Michoacán',
                     '16'   => 'Morelos',
                     '17'   => 'Nayarit',
                     '18'   => 'Nuevo León',
                     '19'   => 'Oaxaca',
                     '20'   => 'Puebla',
                     '21'   => 'Querétaro',
                     '22'   => 'Quintana Roo',
                     '23'   => 'San Luis Potosí',
                     '24'   => 'Sinaloa',
                     '25'   => 'Sonora',
                     '26'   => 'Tabasco',
                     '27'   => 'Tamaulipas',
                     '28'   => 'Tlaxcala',
                     '29'   => 'Veracruz',
                     '30'   => 'Yucatán',
                     '31'   => 'Zacatecas',
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
