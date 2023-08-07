<?php

namespace App\Controller;

use App\Entity\ReservaSpinning;
use App\Repository\BicicletaRepository;
use App\Repository\ReservaSpinningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ReservaController extends AbstractController
{

    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/reservar_bicicleta', name: 'reserva_bicicleta', methods: 'POST')]
    public function reservarBicicleta(Request $request, EntityManagerInterface $entityManager, BicicletaRepository $bicicletaRepository, ReservaSpinningRepository $reservaSpinningRepository)
    {
        // Obtener el ID de la bicicleta y la fecha actual o fecha seleccionada
        $bikeId = $request->request->get('bikeId');
        $fecha = new \DateTime(); // Obtener la fecha actual o utilizar la fecha seleccionada en tu lógica

        // Verificar si ya existe una reserva para esa bicicleta en la misma fecha
        $reservaExistente = $reservaSpinningRepository->findOneBy(['bicicleta' => $bikeId, 'Fecha' => $fecha]);

        // Si ya existe una reserva, devolver un mensaje de error
        // ...
        if ($reservaExistente) {
            return $this->json(['error' => 'Ya existe una reserva para esta bicicleta en la misma fecha.'], Response::HTTP_BAD_REQUEST);
        }
        // ...


        // Crear la reserva normalmente
        $reserva = new ReservaSpinning();
        $reserva->setBicicleta($bicicletaRepository->find($bikeId));
        $reserva->setUsuario($this->security->getUser());
        $reserva->setFecha($fecha);

        // Guardar la reserva en la base de datos
        $entityManager->persist($reserva);
        $bicicleta = $bicicletaRepository->find($bikeId);
        $entityManager->flush();
        return $this->json(['message' => 'Reserva creada correctamente']);
    }
}
