<?php

namespace App\Controller;

use App\Repository\BonoRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BonoController extends AbstractController
{
    private $usuarioRepository;
    private $bonoRepository;

    public function __construct(UsuarioRepository $usuarioRepository, BonoRepository $bonoRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->bonoRepository = $bonoRepository;
    }

    #[Route('/bono', name: 'app_bono')]
    public function index(): Response
    {
        return $this->render('bono/index.html.twig', [
            'controller_name' => 'BonoController',
        ]);
    }

    #[Route('/bono2', name: 'app_bono2')]
    public function mostrarBonoAction($idUsuario = 1)
    {
        // Obtener el usuario desde la base de datos
        $usuario = $this->usuarioRepository->find($idUsuario);

        // Verificar si el usuario existe
        if (!$usuario) {
            throw $this->createNotFoundException('Usuario no encontrado');
        }

        // Obtener el bono del usuario
        $bono = $usuario->getBonos()->first();

        // Renderizar la plantilla con los datos del bono
        return $this->render('bono/mostrarBono.html.twig', [
            'usuario' => $usuario,
            'bono' => $bono,
        ]);
    }
}
