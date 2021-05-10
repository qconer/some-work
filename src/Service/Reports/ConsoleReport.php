<?php

namespace App\Service\Reports;

use App\Entity\GameSet;
use App\Exception\ConsoleReportException;
use App\Service\GenerateReport;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConsoleReport
{
    public function __construct(
        private GenerateReport $generateReport
    ){}

    public function get(GameSet $gameSet, InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $report = $this->generateReport->getReport($gameSet);
        $io->table(
            ['Parameters', 'Data'],
            [
                ['game count', $report->getGameCount()],
                ['wins-count-left-player', $report->getWinsCountLeftPlayer()],
                ['wins-count-right-player', $report->getWinsCountRightPlayer()],
                ['draws-count', $report->getDrawsCount()],
                ['choice-count-paper', $report->getChoiceCountPaper()],
                ['choice-count-scissors', $report->getChoiceCountScissors()],
                ['choice-count-stone', $report->getChoiceCountStone()],
                ['win-reit-left-player', $report->getWinRateLeftPlayer() . '%'],
                ['wins-reit-right-player', $report->getWinRateRightPlayer() . '%'],
                ['draws-reit', $report->getDrawRating() . '%'],
            ]
        );
    }
}