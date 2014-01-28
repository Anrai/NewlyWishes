<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProveedoresController extends Controller
{
    public function loginAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:login.html.twig');
    }

    public function micuentaAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:micuenta.html.twig');
    }

    public function misproductosAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:misproductos.html.twig');
    }
}