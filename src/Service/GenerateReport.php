<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\GameSet;
use App\Entity\PlayerChoice;
use App\Interfaces\ReportInterface;
use Doctrine\ORM\EntityManagerInterface;

class GenerateReport
{
    public function __construct(
        private EntityManagerInterface $entityManager, // зачем тут целый entityManager? можно было обойтись репозиториями. они у тебя extends ServiceEntityRepository
        private ReportInterface $report
    ) {}

    public function getReport(GameSet $gameSet): ReportInterface
    {
        $gameRepository = $this->entityManager->getRepository(Game::class);
        $playerChoiceRepository = $this->entityManager->getRepository(PlayerChoice::class);

        $result = $gameRepository->getWinnerCountByGameSetId($gameSet->getId());
        $choicesStatistics = $playerChoiceRepository->getChoicesByGameSetId($gameSet->getId());

        return $this->report
            ->setGameCount($gameSet->getGameCount())
            ->setWinsCountLeftPlayer($result['left'] ?? 0)
            ->setWinsCountRightPlayer($result['right'] ?? 0)
            ->setDrawsCount($result['draw'] ?? 0)
            ->setChoiceCountPaper($choicesStatistics['paper'] ?? 0)
            ->setChoiceCountScissors($choicesStatistics['scissors'] ?? 0)
            ->setChoiceCountStone($choicesStatistics['stone'] ?? 0)
        ;
    }
}