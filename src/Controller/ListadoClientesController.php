<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListadoClientesController extends AbstractController
{

    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    #[Route('/listado/clientes', name: 'app_listado_clientes')]
    public function index(): Response
    {

        $users = $this->usuarioRepository->findAll();
        return $this->render('listado_clientes/index.html.twig', [
            'controller_name' => 'ListadoClientesController',
            'usuarios' => $users
        ]);
    }
}
