<?php

namespace NW\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NW\UserBundle\Entity\usuario;
use NW\UserBundle\Entity\registronovios;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class UserController extends Controller
{
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

            ->add('noviaPais', 'choice', array('choices'   => array(
                    'MX'   => 'México',
                    'afternoon' => 'Afternoon',
                    'evening'   => 'Evening',
                    ), 'multiple'  => false,))
            ->add('noviaEstado', 'choice', array('choices'   => array(
                     ''   => 'Aguascalientes',
                     ''   => 'Baja California',
                     ''   => 'Baja California Sur',
                     ''   => 'Campeche',
                     ''   => 'Chiapas',
                     ''   => 'Chihuahua',
                     ''   => 'Coahuila',
                     ''   => 'Colima',
                     ''   => 'Distrito Federal',
                     ''   => 'Durango',
                     ''   => 'Estado de México',
                     ''   => 'Guanajuato',
                     ''   => 'Guerrero',
                     ''   => 'Hidalgo',
                     ''   => 'Jalisco',
                     ''   => 'Michoacán',
                     ''   => 'Morelos',
                     ''   => 'Nayarit',
                     ''   => 'Nuevo León',
                     ''   => 'Oaxaca',
                     ''   => 'Puebla',
                     ''   => 'Querétaro',
                     ''   => 'Quintana Roo',
                     ''   => 'San Luis Potosí',
                     ''   => 'Sinaloa',
                     ''   => 'Sonora',
                     ''   => 'Tabasco',
                     ''   => 'Tamaulipas',
                     ''   => 'Tlaxcala',
                     ''   => 'Veracruz',
                     ''   => 'Yucatán',
                     ''   => 'Zacatecas',
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
            ->add('novioPais', 'country')
            ->add('novioEstado', 'text')
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
            // guardar la tarea en la base de datos
            return $this->redirect($this->generateUrl('task_success'));
        }
        else{
            return $this->render('NWUserBundle:User:registronovios.html.twig', array(
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
