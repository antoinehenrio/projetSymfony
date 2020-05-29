<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Form\ProduitEditType;
use App\Repository\MarquesRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/admin/produits", name="admin_produits")
     */
    public function index()
    {
        /*
        $user = $this->getUser();
        dump($user);
        $hasAccess = $this->isGranted('ROLE_TOTO');
        dump($hasAccess);
        $this->denyAccessUnlessGranted('ROLE_TITI');
        */

        $produitsRepository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $produitsRepository->findAll();
        return $this->render('admin/produits/index.html.twig',[
            'produits' => $produits
        ]);
    }


    /**
     * @Route  ("/admin/produit/add", name="admin.produit.add")
     */
    public function add(Request $request, FileUploader $fileUploader){
        $produit = new Produits();
        $form = $this->createForm(ProduitEditType::class,$produit);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $imagePath */
            $imagePath = $form->get('imagePath')->getData();
            if($imagePath){
                try {
                    $imageFileName = $fileUploader->upload($imagePath);
                    $produit->setImagePath($imageFileName);
                }catch (FileException $e){
                    $form->addError($e);
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }

        return $this->render('admin/produits/add.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produits/{id}", name="admin.produit.edit")
     */
    public function edit(Produits $produits, Request $request, FileUploader $fileUploader){
        $form = $this->createForm(ProduitEditType::class,$produits);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $imagePath */
            $imagePath = $form->get('imagePath')->getData();
            if($imagePath){
                try {
                    $imageFileName = $fileUploader->upload($imagePath);
                    $produits->setImagePath($imageFileName);
                }catch (FileException $e){
                    $form->addError($e);
                }
            }
           $em = $this->getDoctrine()->getManager();
           $em->flush();
        }

        return $this->render('admin/produits/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produit/delete/{id}", name="admin.produit.delete", methods="DELETE")
     */
    public function delete(Produits $produit,Request $request){
        return $this->redirectToRoute('admin_produits');
    }
}