<?php

namespace App\Repository;

use App\Entity\GameSet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameSet|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameSet|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameSet[]    findAll()
 * @method GameSet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameSetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameSet::class);
    }
}
