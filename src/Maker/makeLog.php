<?php

namespace App\Maker;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class MakeLog extends AbstractMaker {
    public static function getCommandName(): string {
        return 'make:log';
    }
    public function getCommandDescription(): string {
        return 'Create a logger';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig) {
        $command
            ->setDescription($this->getCommandDescription())
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/MakeLog.txt'));
    }

    public function configureDependencies(DependencyBuilder $dependencies) { }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator) {
        $generator->generateFile(
            'src/logger.php',
            __DIR__.'/../Resources/skeleton/logger.php.twig',
            []
        );
    }
}