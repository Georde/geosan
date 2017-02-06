<?php
namespace Geosan\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Geosan\Manipulate\CreateManipulate;

class CreateRoute extends Command{

	protected function configure(){
		$this->setName("create:route")
		->setDescription('Create new Route')
		->setHelp("This command is used to create new Route");

		$this->addArgument('route', InputArgument::REQUIRED, 'The route url')
		->addArgument('controller', InputArgument::REQUIRED, 'Controller to use');
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$route = $input->getArgument('route');
		$controller = $input->getArgument('controller');

		$createManipulate = new CreateManipulate();
		$createManipulate->successAdded = "<info>Route created with success!</info>";

		return $output->writeln($createManipulate->createRoute($route, $controller));
	}

}