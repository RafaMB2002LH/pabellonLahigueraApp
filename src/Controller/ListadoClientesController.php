<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ListadoClientesController extends AbstractController
{

    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    #[Route('/listado/clientes', name: 'app_listado_clientes')]
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        if ($user == null) {
            return $this->render('error/sinInicioDeSesion.html.twig', ['mensajeError' => 'Necesitas iniciar sesión para acceder a esta página.']);
        } else {
            $users = $this->usuarioRepository->findAll();
            return $this->render('listado_clientes/index.html.twig', [
                'controller_name' => 'ListadoClientesController',
                'usuarios' => $users
            ]);
        }
    }
}
