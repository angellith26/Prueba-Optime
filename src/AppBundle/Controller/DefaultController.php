<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\ProductoType;


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
        $repository = $this->getDoctrine()->getRepository(Producto::class);
        $productos = $repository->findAll();

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
     * @Route("/update/categorias/{id}", name="update_categorias")
     */
    public function updateCategorias(Request $request)
    {

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
}
