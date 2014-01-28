<?php

namespace NW\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NW\UserBundle\Entity\usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;


class UserController extends Controller
{
    public function asignarRolesAction()
    {

        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => 'Docser'));
        //$user->addRole('ROLE_ONE');
        $user->setRoles(array('ROLE_USER1','ROLE_USER2','ROLE_USER3'));
        $userManager->updateUser($user);

        return new Response('Nuevo rol asignado correctamente al usuario '.$user->getId());
    }

    public function registronoviosAction()
    {
        return $this->render('NWUserBundle:Default:registronovios.html.twig');
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
