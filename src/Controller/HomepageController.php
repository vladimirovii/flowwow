<?php

namespace App\Controller;

use App\Form\SelectionTourFormType;
use App\Model\SelectionTour;
use App\UseCase\SelectionTour\SelectionTourHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomepageController extends AbstractController
{
    public function __construct(
        private readonly SelectionTourHandler $selectionTourHandler,
    ) {
    }

    #[Route('', name: 'app_home_page')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SelectionTourFormType::class, $selectionTour = new SelectionTour());
        $form->handleRequest($request);

        $totalAmount = 0;
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $totalAmount = $this->selectionTourHandler->calculateTotalAmount($selectionTour);
            }
        }

        return $this->render('home_page/index.html.twig', [
            'form' => $form->createView(),
            'totalAmount' => $totalAmount,
        ]);
    }
}
