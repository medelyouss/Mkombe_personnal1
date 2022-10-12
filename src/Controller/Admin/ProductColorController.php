<?php

namespace App\Controller\Admin;

use App\Entity\Productcolor;
use App\Form\Admin\ProductcolorType;
use App\Repository\ProductcolorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/color")
 */
class ProductcolorController extends Abstractcontroller
{
    /**
     * @Route("/", name="app_color_index", methods={"GET"})
     */
    public function index(ProductcolorRepository $productcolorRepository): Response
    {
        return $this->render('admin/color/index.html.twig', [
            'product_colors' => $productcolorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_color_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProductcolorRepository $productcolorRepository): Response
    {
        $productcolor = new Productcolor();
        $form = $this->createForm(ProductcolorType::class, $productcolor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productcolorRepository->add($productcolor, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/new.html.twig', [
            'product_color' => $productcolor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_show", methods={"GET"})
     */
    public function show(Productcolor $productcolor): Response
    {
        return $this->render('admin/color/show.html.twig', [
            'product_color' => $productcolor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_color_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Productcolor $productcolor, ProductcolorRepository $productcolorRepository): Response
    {
        $form = $this->createForm(ProductcolorType::class, $productcolor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productcolorRepository->add($productcolor, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/edit.html.twig', [
            'product_color' => $productcolor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_delete", methods={"POST"})
     */
    public function delete(Request $request, Productcolor $productcolor, ProductcolorRepository $productcolorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productcolor->getId(), $request->request->get('_token'))) {
            $productcolorRepository->remove($productcolor, true);
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
