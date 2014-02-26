<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createAction()
	{
	    $product = new Product();
	    $product->setName('A Foo Bar');
	    $product->setPrice('19.99');
	    $product->setDescription('Lorem ipsum dolor');
	 
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($product);
	    $em->flush();
	 
	    return new Response('Created product id '.$product->getId());
	}

	public function showAction($id)
	{
	    $product = $this->getDoctrine()
	        ->getRepository('AcmeStoreBundle:Product')
	        ->find($id);
	 
	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    return $this->render('AcmeStoreBundle:Default:show.html.twig', array('descripcion' => $product->getDescription()));
	}

	public function updateAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $product = $em->getRepository('AcmeStoreBundle:Product')->find($id);
	 
	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }
	 
	    $product->setName('New product name!');
	    $em->flush();
	 
	    return $this->redirect($this->generateUrl('nw_principal_homepage'));
	}

	public function removeAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $product = $em->getRepository('AcmeStoreBundle:Product')->find($id);
	 
	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }
	 
	    $em->remove($product);
	    $em->flush();
	 
	    return $this->redirect($this->generateUrl('nw_principal_homepage'));
	}

	public function findAction()
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
		    'SELECT p
		       FROM AcmeStoreBundle:Product p
		      WHERE p.price > :price
		   ORDER BY p.price ASC'
		)->setParameter('price', '19.99');
		 
		$products = $query->getResult();

		return $this->render('AcmeStoreBundle:Default:find.html.twig', array('products' => $products['id']->getDescription() ));
	}

	public function ordenarAction()
	{
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('AcmeStoreBundle:Product')
               		   ->findAllOrderedByName();

        return $this->render('AcmeStoreBundle:Default:find.html.twig', array('products' => $products ));
	}

	public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
