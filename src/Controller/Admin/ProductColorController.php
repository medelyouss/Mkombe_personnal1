<?php

namespace App\Controller\Admin;

use App\Entity\ProductColor;
use App\Form\Admin\ProductColorType;
use App\Repository\ProductColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/color")
 */
class ProductColorController extends AbstractController
{
    /**
     * @Route("/", name="app_color_index", methods={"GET"})
     */
    public function index(ProductColorRepository $productColorRepository): Response
    {
        return $this->render('admin/color/index.html.twig', [
            'product_colors' => $productColorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_color_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProductColorRepository $productColorRepository): Response
    {
        $productColor = new ProductColor();
        $form = $this->createForm(ProductColorType::class, $productColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productColorRepository->add($productColor, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/new.html.twig', [
            'product_color' => $productColor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_show", methods={"GET"})
     */
    public function show(ProductColor $productColor): Response
    {
        return $this->render('admin/color/show.html.twig', [
            'product_color' => $productColor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_color_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProductColor $productColor, ProductColorRepository $productColorRepository): Response
    {
        $form = $this->createForm(ProductColorType::class, $productColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productColorRepository->add($productColor, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/edit.html.twig', [
            'product_color' => $productColor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductColor $productColor, ProductColorRepository $productColorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productColor->getId(), $request->request->get('_token'))) {
            $productColorRepository->remove($productColor, true);
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
