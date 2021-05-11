<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function getWinnerCountByGameSetId(int $gameSetId): array
    {
        $queryResult = $this
            ->createQueryBuilder('g')
            ->select('g.winner, count(g.id) as count')
            ->where('g.gameSet = :gsi')
            ->setParameter('gsi', $gameSetId) // можно было объект сюда передать. доктрина так умеет. а там где есть только айди в коде, то доставать через getReference
            ->groupBy('g.winner')
            ->getQuery()
            ->getResult();

        $result = [];
        foreach ($queryResult as $item) {
            $result[$item['winner']] = $item['count'];
        }

        return $result;
    }
}
