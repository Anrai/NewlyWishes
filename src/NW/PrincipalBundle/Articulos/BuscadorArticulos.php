<?php

// src/NW/PrincipalBundle/Articulos/BuscadorArticulos.php
namespace NW\PrincipalBundle\Articulos;

class BuscadorArticulos
{
    protected $em; // Doctrine Entity Manager
    protected $router; // Para gererar rutas url

    public function __construct($router, $em)
    {
    	$this->em = $em;
    	$this->router = $router;
    }

    public function quitarAcentos($palabra)
	{
        $no_permitidas = array ('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ');
        $si_permitidas = array ('a','e','i','o','u','A','E','I','O','U','n','N');

        $palabra = str_replace($no_permitidas, $si_permitidas, $palabra);

		return $palabra;
	}

	public function generarLink($categoria, $otraCategoria, $proveedor)
	{
		$link = $this->router->generate('nw_principal_articulos'); // Link que se regresará

		if($categoria)
		{
			$catEntity = $this->em->getRepository('NWPrincipalBundle:Categorias'); // Entidad de Categorias
            $catObj = $catEntity->find($categoria); // Categoria recuperada como objeto
            $catName = $catObj->getNombre(); // Nombre de la categoria recuperada
            $catName = $this->quitarAcentos($catName); // Sin acentos

            $link.= $catName;
		}

		return $link;

	}
 
    // ...
}

