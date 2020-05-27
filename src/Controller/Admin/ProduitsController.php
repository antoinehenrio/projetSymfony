<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/admin/produits", name="admin_produits")
     */
    public function index()
    {
        return $this->render('admin/produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
        ]);
    }
}
