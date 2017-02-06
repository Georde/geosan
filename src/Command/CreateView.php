<?php
namespace Geosan\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Geosan\Manipulate\CreateManipulate;

class CreateView extends Command{

	private $typeAvailable = array(
		'html',
		'empty'
	);

	protected function configure(){
		$this->setName("create:view")
		->setDescription('Create new view')
		->setHelp("This command is used to create new View");

		$this->addArgument('name', InputArgument::REQUIRED, 'The view name');
		$this->addArgument('module', InputArgument::OPTIONAL, 'The module name');
		$this->addOption('type', null,  InputOption::VALUE_OPTIONAL, 'The type of view', 1);
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$name = $input->getArgument('name');
		$module = $input->getArgument('module');
		$type = (strlen($input->getOption('type')) > 1) ? $input->getOption('type') : false;

		if($type !== false and !in_array($type, $this->typeAvailable))
			return $output->writeln("<error>{$type} is not a know type of view</error>");

		$createManipulate = new CreateManipulate();
		$createManipulate->successCreate = "<info>View created with success!</info>";

		return $output->writeln($createManipulate->createView($name, $module, $type));
	}
}