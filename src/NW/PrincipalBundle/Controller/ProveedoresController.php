<?php

namespace NW\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProveedoresController extends Controller
{
    public function micuentaAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:micuenta.html.twig');
    }

    public function misproductosAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:misproductos.html.twig');
    }

    public function misbannersAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:misbanners.html.twig');
    }

    public function misanunciosAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:misanuncios.html.twig');
    }

    public function misresenasAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:misresenas.html.twig');
    }

    public function miestadodecuentaAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:miestadodecuenta.html.twig');
    }

    public function miscodigosAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:miscodigos.html.twig');
    }

    public function miinformacionbancariaAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:miinformacionbancaria.html.twig');
    }

    public function tutorialesAction()
    {
        return $this->render('NWPrincipalBundle:Proveedores:mtutoriales.html.twig');
    }
}