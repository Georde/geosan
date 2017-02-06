<?php
namespace Geosan\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Geosan\Manipulate\CreateManipulate;

class CreateHelper extends Command{

	protected function configure(){
		$this->setName("create:helper")
		->setDescription('Create new Helper')
		->setHelp("This command is used to create new Helper");

		$this->addArgument('name', InputArgument::REQUIRED, 'The helper name');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$name = $input->getArgument('name');

		$createManipulate = new CreateManipulate();
		$createManipulate->successCreate = "<info>Helper created with success!</info>";

		return $output->writeln($createManipulate->createHelper($name));
	}

}