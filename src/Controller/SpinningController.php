<?php

namespace App\Controller;

use App\Entity\Bicicleta;
use App\Entity\ReservaSpinning;
use App\Repository\BicicletaRepository;
use App\Repository\ReservaSpinningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class SpinningController extends AbstractController
{

    private $bicicletaRepository;
    private $reservaSpinningRepository;
    private $entityManager;

    public function __construct(BicicletaRepository $bicicletaRepository, ReservaSpinningRepository $reservaSpinningRepository, EntityManagerInterface $entityManager)
    {
        $this->bicicletaRepository = $bicicletaRepository;
        $this->reservaSpinningRepository = $reservaSpinningRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/spinning-reserva', name: 'app_spinning_reserva')]
    public function index(Security $security): Response
    {

        $user = $security->getUser();

        if ($user == null) {
            return $this->render('error/sinInicioDeSesion.html.twig', ['mensajeError' => 'Necesitas iniciar sesión para acceder a esta página.']);
        } else {
            $bicicletas = $this->bicicletaRepository->findAll();

            $queryBuilder = $this->entityManager->createQueryBuilder();

            $queryBuilder
                ->select('DISTINCT b')
                ->from('App\Entity\Bicicleta', 'b')
                ->innerJoin('App\Entity\ReservaSpinning', 'r', 'WITH', 'b.id = r.bicicleta')
                ->where($queryBuilder->expr()->eq('r.Fecha', 'CURRENT_DATE()'));

            $bicicletasReservadasHoy = $queryBuilder->getQuery()->getResult();

            return $this->render('spinning/index.html.twig', [
                'controller_name' => 'SpinningController',
                'bicicletas' => $bicicletas,
                'bicicletasConReserva' => $bicicletasReservadasHoy
            ]);
        }
    }


    /* #[Route('/crear_bicicletas', name: 'crear_bicicletas')]
    public function crearBicicletas(EntityManagerInterface $entityManager)
    {
        // Crear 16 bicicletas de prueba
        for ($i = 1; $i <= 16; $i++) {
            $bicicleta = new Bicicleta();
            $bicicleta->setDisponibilidad(true);
            $bicicleta->setEstado("Ready");
            
            $entityManager->persist($bicicleta);
        }
        
        $entityManager->flush();

        return $this->redirectToRoute('app_spinning');
    } */
}
