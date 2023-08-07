<?php

namespace App\Repository;

use App\Entity\Bicicleta;
use App\Entity\ReservaSpinning;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\Join;
use Doctrine\ORM\Query\Expr\Join as ExprJoin;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservaSpinning>
 *
 * @method ReservaSpinning|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservaSpinning|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservaSpinning[]    findAll()
 * @method ReservaSpinning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaSpinningRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservaSpinning::class);
    }

    public function save(ReservaSpinning $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservaSpinning $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBicicletasConReserva(): array
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->from(Bicicleta::class, 'b')
            ->leftJoin(ReservaSpinning::class, 'r', 'WITH', 'b.id = r.bicicleta')
            ->where('r.fecha', ':fechaActual')
            ->setParameter('fechaActual', new \DateTime());

        $query = $qb->getQuery();
        return $query->getResult();
    }

    //    /**
    //     * @return ReservaSpinning[] Returns an array of ReservaSpinning objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ReservaSpinning
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
