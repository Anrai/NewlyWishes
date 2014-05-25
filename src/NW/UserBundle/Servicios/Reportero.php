<?php
// src/NW/UserBundle/Servicios/Reportero.php
namespace NW\UserBundle\Servicios;

class Reportero
{
    protected $em; // Doctrine Entity Manager
    protected $userManager; // Manejador de usuarios FOS

    public function __construct($em, $userManager)
    {
    	$this->em = $em;
        $this->userManager = $userManager;
    }

	public function registrarReportero($reportero, $userName, $userPass)
    {
        // Obtener estado
        $estadoEntity = $this->em->getRepository('NWPrincipalBundle:Estados');
        $estado = $estadoEntity->find($reportero->getEstadoId());

        // Creando Usuario
        $user = $this->userManager->createUser(); 
        $user->setUsername($userName);
        $user->setEmail($reportero->getEmail());
        $user->setPlainPassword($userPass);
        $user->setEnabled(true);
        $user->addRole('ROLE_REPORTERO');

        // Agregando Reportero
        $reportero->setUser($user);
        $reportero->setEstado($estado);

        // Persistiendo a base de datos
        $this->em->persist($user);
        $this->em->persist($reportero);
        $this->em->flush();

        return true;
    }
 
}