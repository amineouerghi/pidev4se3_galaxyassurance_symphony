<?php

namespace App\Controller;

use App\Entity\DemandeContart;
use App\Form\DemandeContartType;
use App\Repository\DemandeContartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande/contart")
 */
class DemandeContartController extends AbstractController
{
    /**
     * @Route("/", name="demande_contart_index", methods={"GET"})
     */
    public function index(DemandeContartRepository $demandeContartRepository): Response
    {
        return $this->render('demande_contart/index.html.twig', [
            'demande_contarts' => $demandeContartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demande_contart_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeContart = new DemandeContart();
        $form = $this->createForm(DemandeContartType::class, $demandeContart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandeContart);
            $entityManager->flush();

            return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_contart/new.html.twig', [
            'demande_contart' => $demandeContart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_contart_show", methods={"GET"})
     */
    public function show(DemandeContart $demandeContart): Response
    {
        return $this->render('demande_contart/show.html.twig', [
            'demande_contart' => $demandeContart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_contart_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DemandeContart $demandeContart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeContartType::class, $demandeContart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_contart/edit.html.twig', [
            'demande_contart' => $demandeContart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_contart_delete", methods={"POST"})
     */
    public function delete(Request $request, DemandeContart $demandeContart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeContart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($demandeContart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
    }
}
