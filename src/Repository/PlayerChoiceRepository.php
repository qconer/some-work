<?php

namespace App\Repository;

use App\Entity\PlayerChoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerChoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerChoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerChoice[]    findAll()
 * @method PlayerChoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerChoice::class);
    }

    public function getChoicesByGameSetId(int $gameSetId): array
    {
        $queryResult = $this->createQueryBuilder('p')
            ->select('p.choice, count(p.id) as count')
            ->where('gs.id = :game_set_id')
            ->leftJoin('p.game', 'g')
            ->leftJoin('g.gameSet', 'gs')
            ->setParameter('game_set_id', $gameSetId)
            ->groupBy('p.choice')
            ->getQuery()
            ->getResult();

        $result = [];
        foreach ($queryResult as $item) {
            $result[$item['choice']] = $item['count'];
        }

        return $result;
    }
}
