<?php

namespace App\Controller\Admin;

use App\Entity\Productcategory;
use App\Form\Admin\ProductcategoryType;
use App\Repository\ProductcategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/product_category")
 */
class ProductcategoryController extends AbstractController
{
    /**
     * @Route("/", name="productcategory_index", methods={"GET"})
     */
    public function index(ProductcategoryRepository $productcategoryRepository): Response
    {
        return $this->render('admin/product/category/index.html.twig', [
            'productcategories' => $productcategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="productcategory_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProductcategoryRepository $productcategoryRepository): Response
    {
        $productcategory = new Productcategory();
        $form = $this->createForm(ProductcategoryType::class, $productcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productcategoryRepository->add($productcategory, true);

            return $this->redirectToRoute('productcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        $this->addFlash('success', "Catégorie ajoutée avec succès!");

        return $this->renderForm('admin/product/category/new.html.twig', [
            'productcategory' => $productcategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="productcategory_show", methods={"GET"})
     */
    public function show(Productcategory $productcategory): Response
    {
        return $this->render('admin/product/category/show.html.twig', [
            'productcategory' => $productcategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="productcategory_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Productcategory $productcategory, ProductcategoryRepository $productcategoryRepository): Response
    {
        $form = $this->createForm(ProductcategoryType::class, $productcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productcategoryRepository->add($productcategory, true);

            return $this->redirectToRoute('productcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/category/edit.html.twig', [
            'productcategory' => $productcategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="productcategory_delete", methods={"POST"})
     */
    public function delete(Request $request, Productcategory $productcategory, ProductcategoryRepository $productcategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productcategory->getId(), $request->request->get('_token'))) {
            $productcategoryRepository->remove($productcategory, true);
        }

        return $this->redirectToRoute('productcategory_index', [], Response::HTTP_SEE_OTHER);
    }
}
