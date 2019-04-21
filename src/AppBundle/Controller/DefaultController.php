<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('optime/index.html.twig');
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productosAction(Request $request)
    {
        /*
        $repository = $this->getDoctrine()->getRepository(Producto::class);
        $productos = $repository->findAll();
        */

        $productos = $this->getDoctrine()->getRepository(Producto::class)
        ->findByProductActive();

        /*
        var_dump($productos);
        die();
        */

        // replace this example code with whatever you need
        return $this->render('optime/productos.html.twig',array('productos'=>$productos));
    }

    /**
     * @Route("/producto/ver/{id}", name="productoVer")
     */
    public function productoVerAction(Request $request, $id=null)
    {
        if ($id!=null){

            $repository = $this->getDoctrine()->getRepository(Producto::class);
            $producto = $repository->find($id);
            return $this->render('optime/productoVer.html.twig',array('producto'=>$producto));
        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }

    /**
     * @Route("/producto/nuevo", name="productoNuevo")
     */
    public function productoNuevoAction(Request $request)
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $producto = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('productos');
        }

        // replace this example code with whatever you need
        return $this->render('optime/productoNuevo.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/producto/actualizar/{id}", name="productoActualizar")
     */
    public function productoActualizar(Request $request, $id)
    {
        $producto = new Producto();
        $em =$this->getDoctrine()->getManager();
        $producto = $em->getRepository('AppBundle:Producto')->find($id);
        $form = $this->createForm(ProductoType::class, $producto);    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('productos');
        }

        // replace this example code with whatever you need
        return $this->render('optime/productoActualizar.html.twig',array('form'=>$form->createView()));
    }

        /**
     * @Route("/producto/eliminar/{id}", name="productoEliminar")
     */
    public function productoEliminar($id)
    {
        $em =$this->getDoctrine()->getManager();
        $producto = $em->getRepository('AppBundle:Producto')->find($id);
        if (!$producto) {
            throw $this->createNotFoundException(' El producto con ID '.$id.' no existe');
            
        }
        $em->remove($producto);
        $em->flush();

        return $this->redirectToRoute('productos');
    }

    /**
     * @Route("/categorias", name="categorias")
     */
    public function categoriasAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('optime/categorias.html.twig',array('categorias'=>$categorias));
    }

    /**
     * @Route("/categoria/ver/{id}", name="categoriaVer")
     */
    public function categoriaVerAction(Request $request, $id=null)
    {
        if ($id!=null){

            $repository = $this->getDoctrine()->getRepository(Categoria::class);
            $categoria = $repository->find($id);
            return $this->render('optime/categoriaVer.html.twig',array('categoria'=>$categoria));
        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }

    /**
     * @Route("/categoria/nuevo", name="categoriaNuevo")
     */
    public function categoriaNuevoAction(Request $request)
    {
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $categoria = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            return $this->redirectToRoute('categorias');
        }

        // replace this example code with whatever you need
        return $this->render('optime/categoriaNuevo.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/categoria/actualizar/{id}", name="categoriaActualizar")
     */
    public function categoriaActualizar(Request $request, $id)
    {
        $categoria = new Categoria();
        $em =$this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppBundle:Categoria')->find($id);
        $form = $this->createForm(CategoriaType::class, $categoria);    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('categorias');
        }

        // replace this example code with whatever you need
        return $this->render('optime/categoriaActualizar.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/categoria/eliminar/{id}", name="categoriaEliminar")
     */
    public function categoriaEliminar($id)
    {
        $em =$this->getDoctrine()->getManager();

        $categoria = $em->getRepository('AppBundle:Categoria')->find($id);
        if (!$categoria) {
            throw $this->createNotFoundException(' La Categoria con ID '.$id.' no existe');
            
        }
        $em->remove($categoria);
        $em->flush();

        return $this->redirectToRoute('categorias');
    }
}
