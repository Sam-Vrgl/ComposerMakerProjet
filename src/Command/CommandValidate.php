<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Log\Log;

class ValidateCommand extends Command {
    protected static $defaultName = 'app:validate';

    protected function configure() {
        $this
            ->setDescription('Validate your composer.json file');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $log = new Log();
        $log->checkComposer();

        return Command::SUCCESS;
    }
}