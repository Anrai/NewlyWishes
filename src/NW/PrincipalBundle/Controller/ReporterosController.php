<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NW\PrincipalBundle\Form\Type\BusquedaArticulosType;
use NW\UserBundle\Form\Type\ReporteroType;

class ReporterosController extends Controller
{
	public function micuentaAction(Request $request)
    {
    	// Servicio con funciones para reportero
    	$reporteroService = $this->get('reportero_service');

    	// Formulario de edición de reportero
    	$reportero = $reporteroService->getReportero($this->getUser());
    	$formReportero = $this->createForm(new ReporteroType(), $reportero);

    	// Formulario de cambio de contraseña
        $formPassword = $this->createFormBuilder()
            ->add('oldPass', 'password')
            ->add('newPass', 'password')
            ->add('Cambiar', 'submit')
            ->getForm();

        // Recuperando formularios
        if('POST' === $request->getMethod()) {
            // Formulario de cambio de contraseña
            if($request->request->has($formPassword->getName())) {
                $formPassword->handleRequest($request);
                if($formPassword->isValid())
                {
                }
            }
            // Formulario de actualización de datos
            else if($request->request->has($formReportero->getName())) {
                $formReportero->handleRequest($request);
                if($formReportero->isValid())
                {
                	$reporteroService->actualizarReportero($reportero);
                }
            }
        }

        // Obtener datos de reportero según el usuario en formato para mostrar en plantilla
    	$reporteroArray = $reporteroService->getReporteroArray($this->getUser());

    	return $this->render('NWPrincipalBundle:Reporteros:micuenta.html.twig', array(
    		'reportero' => $reporteroArray,
    		'formPassword' => $formPassword->createView(),
    		'formReportero' => $formReportero->createView(),
    	));
    }
}