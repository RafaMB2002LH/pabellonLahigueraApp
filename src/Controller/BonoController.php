<?php

namespace App\Controller;

use App\Entity\Bono;
use App\Entity\DiaTachado;
use App\Repository\BonoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonDecode;

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

    #[Route('/bono3', name: 'app_bono3')]
    public function show(Security $security): Response
    {

        $user = $security->getUser();
        if ($user == null) {
            return $this->render('error/sinInicioDeSesion.html.twig', ['mensajeError' => 'Necesitas iniciar sesión para acceder a esta página.']);
        } else {
            $usuario = $this->usuarioRepository->find($user->getId());
            $bono = $usuario->getBonos()->last();
            return $this->render('bono/mostrarBono2.html.twig', [
                'bono' => $bono,
            ]);
        }
    }

    #[Route('/bono3/{id}', name: 'app_bono3_id')]
    public function bonoPorPersona($id): Response
    {
        $usuario = $this->usuarioRepository->find($id);
        $bono = $usuario->getBonos()->last();
        return $this->render('bono/mostrarBono2.html.twig', [
            'bono' => $bono,
        ]);
    }

    #[Route('/tacharDia', name: 'tachar_dia', methods: 'post')]
    public function tacharDia(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $diaTachado = new DiaTachado();

        $diaTachado->setBono($this->bonoRepository->find($data['bonoId']));

        $entityManager->persist($diaTachado);
        $entityManager->flush();

        return new Response('Dia tachado correctamente con la id:' . $diaTachado->getId());
    }
}
