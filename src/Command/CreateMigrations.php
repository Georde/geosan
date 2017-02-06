<?php
namespace Geosan\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Geosan\Manipulate\CreateManipulate;

class CreateMigrations extends Command
{
    protected function configure()
    {
        $this->setName("create:migration")
            ->setDescription('Create new migration')
            ->setHelp("This command is used to create new Migration");

        $this->addArgument('name', InputArgument::REQUIRED, 'The migration name');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $createManipulate = new CreateManipulate();
        $createManipulate->successCreate = "<info>Migration created with success!</info>";

        return $output->writeln($createManipulate->createMigration($name));
    }
}