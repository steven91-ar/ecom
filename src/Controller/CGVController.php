<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CGVController extends AbstractController
{
    #[Route('/cgv', name: 'app_cgv')]
    public function index(ProductRepository $productRepository): Response
    {

        $formation = $productRepository->find(4);
        $soutien = $productRepository->find(5);

        return $this->render('cgv/index.html.twig', [
            'formation' => $formation,
            'soutien' => $soutien,
        ]);
    }
}
