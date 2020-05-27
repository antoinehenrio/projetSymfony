<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/admin/produits", name="admin_produits")
     */
    public function index()
    {
        $produitsRepository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $produitsRepository->findAll();
        return $this->render('admin/produits/index.html.twig',[
            'produits' => $produits
        ]);

    }

    /**
     * @Route  ("/admin/produit/add", name="admin.produit.add")
     */
    public function add(){
        return $this->render('admin/produits/add.html.twig');
    }

    /**
     * @Route("/admin/produits/{id}", name="admin.produit.edit")
     */
    public function edit(){
        return $this->render('admin/produits/edit.html.twig');
    }


    /**
     * @Route("/admin/produit/delete/{id}", name="admin.produit.delete", methods="DELETE")
     */
    public function delete(Produits $produit,Request $request){
        return $this->redirectToRoute('admin_produits');
    }

}