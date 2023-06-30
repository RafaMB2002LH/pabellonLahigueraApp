<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BonoController extends AbstractController
{
    #[Route('/bono', name: 'app_bono')]
    public function index(): Response
    {
        return $this->render('bono/index.html.twig', [
            'controller_name' => 'BonoController',
        ]);
    }
}
