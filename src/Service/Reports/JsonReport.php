<?php

namespace App\Service\Reports;

use App\Entity\GameSet;
use App\Service\GenerateReport;
use Symfony\Component\Console\Output\OutputInterface;

class JsonReport
{
    public function __construct(
        private GenerateReport $generateReport
    ){}

    public function get(GameSet $gameSet, OutputInterface $output): void
    {
        $report = $this->generateReport->getReport($gameSet);
        $output->writeln(PHP_EOL . 'Json:');
        $output->writeln(json_encode([
            'game-count' => $report->getGameCount(),
            'wins-count-left-player' => $report->getWinsCountLeftPlayer(),
            'wins-count-right-player' => $report->getWinsCountRightPlayer(),
            'draws-count' => $report->getDrawsCount(),
            'choice-count-paper' => $report->getChoiceCountPaper(),
            'choice-count-scissors' => $report->getChoiceCountScissors(),
            'choice-count-stone' => $report->getChoiceCountStone(),
            'win-reit-left-player' => $report->getWinRateLeftPlayer(),
            'wins-reit-right-player' => $report->getWinRateRightPlayer(),
            'draws-reit' => $report->getDrawRating(),
        ]));
    }
}