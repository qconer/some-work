<?php

namespace App\Command;

use App\Entity\Game;
use App\Entity\GameSet;
use App\Enum\ReportTypeEnum;
use App\Enum\UserSideEnum;
use App\Service\DetermineWinner;
use App\Service\PlayerChoiceFactory;
use App\Service\Reports\ConsoleReport;
use App\Service\Reports\JsonReport;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameRunCommand extends Command
{
    protected static $defaultName = 'game:run';
    protected static $defaultDescription = 'the command that launches the game "Цу-е-фа"';

    public function __construct(
        string $name = null,
        private DetermineWinner $determineWinner,
        private EntityManagerInterface $entityManager,
        private JsonReport $jsonReport,
        private ConsoleReport $consoleReport,
        private PlayerChoiceFactory $playerChoiceFactory
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addOption('game-rounds', 'gr', InputArgument::OPTIONAL, 'number of rounds in the game', 100)
            ->addOption('random', 'r', InputArgument::OPTIONAL, 'This parameter specifies the selection of one character. He will always choose paper or random value. False = always choose paper. True = always choose random', false)
            ->addOption('report-format', 'f', InputArgument::OPTIONAL, sprintf('Report formant. Value: %s', json_encode(ReportTypeEnum::getAll()) ), ReportTypeEnum::CONSOLE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $gameCount = $input->getOption('game-rounds');
        $allRandom = $input->getOption('random');
        $reportFormat = $input->getOption('report-format');

        $gameSet = (new GameSet())
            ->setStart(new DateTimeImmutable())
            ->setGameCount($gameCount)
        ;

        $progressBar = new ProgressBar($output, $gameCount);
        $progressBar->setFormat('verbose');
        $progressBar->start();

        for ($i = 1; $i <= $gameCount; ++$i) {
            $game = (new Game())->setGameSet($gameSet);

            $leftPlayerChoice = $this->playerChoiceFactory->getPlayerChoice($game, UserSideEnum::LEFT, $allRandom);
            $rightPlayerChoice = $this->playerChoiceFactory->getPlayerChoice(game: $game, userSide: UserSideEnum::RIGHT);

            $winner = $this->determineWinner->handler($leftPlayerChoice->getChoice(), $rightPlayerChoice->getChoice());

            $game->setWinner($winner);

            $this->entityManager->persist($rightPlayerChoice);
            $this->entityManager->persist($leftPlayerChoice);
            $this->entityManager->persist($game);

            $progressBar->advance();
        }

        $gameSet->setFinish(new DateTimeImmutable());
        $this->entityManager->persist($gameSet);
        $this->entityManager->flush();

        match ($reportFormat) {
            ReportTypeEnum::CONSOLE => $this->consoleReport->get($gameSet, $input, $output),
            ReportTypeEnum::JSON => $this->jsonReport->get($gameSet, $output),
        };

        $progressBar->finish();

        $this->entityManager->refresh($gameSet);

        return 0;
    }
}
